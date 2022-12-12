<?php

namespace App\Repository\Admin;

use App\Models\Profile;
use App\Models\Trader;
use App\Models\Admin;
use App\Models\Investor; 
use App\Models\MeetingVerification; 
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminKycMail;
use App\Mail\MeetingMail;
use App\Mail\MeetingStatusMail;
use App\Mail\TraderVerifyMail;
use App\Mail\DeactivatedProfileMail;



class UserRepository {
    public function disable($data) 
    { 

        $profile = Profile::find($data); 
        $profile->blocked = !$profile->blocked; 

        $data = [ 
            'name' => $profile->profileable->firstname, 
            'action' => $profile->blocked ? 'Disabled' : 'Enabled' 
        ]; 

        Mail::to($profile->email)->send(new DeactivatedProfileMail($data)); 

        if ($profile->save()) { 
            return $profile; 
        } else { 
            return false; 
        } 
    }

    
    public function delete($data)
    {
        $profile = Profile::find($data);
        
        if ($profile->profileable_type == 'admin') { 
            $user = Admin::find($profile->profileable->id); 
        } elseif ($profile->profileable_type == 'investor') { 
            $user = Investor::find($profile->profileable->id); 
        } elseif ($profile->profileable_type == 'trader') { 
            $user = Trader::find($profile->profileable->id); 
        } 

        $data = [
            'name' => $user->firstname,
            'action' => 'Deleted'
        ];

        Mail::to($profile->email)->send(new DeactivatedProfileMail($data));

        if ($user->delete()) {

            $profile->delete();
            return true;
        } else {
            return false;
        }
    }


    public function verifyTrader($data)
    {
        $trader = Trader::find($data);
        $trader->verify = true;

        if ($trader->save()) {
            Mail::to($trader->profile->email)->send(new TraderVerifyMail($trader->firstname));

            return $trader;
        } else {
            return false;
        }
    }


    public function createAdmin($data)
    {
        $admin = Admin::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'level' => $data['level']
        ]);

        $admin->profile()->create([
            'email' => $data['email'],
        ]);

        return true;
        
    }

    
    public function updateAdmin($profile, $data)
    {
        $this->updateEmail($profile, $data['email']);

        $admin = Admin::find($profile->profileable_id);
        $admin->firstname = $data['firstname'];
        $admin->lastname = $data['lastname'];
        $admin->level = $data['level'];
        
        if ($admin->save()) {
            return $profile;
        } else {
            return false;
        }
    }


    public function updateInvestor($profile, $data)
    {
        $this->updateEmail($profile, $data['email']);

        $investor = Investor::find($profile->profileable_id);
        $investor->firstname = $data['firstname'];
        $investor->lastname = $data['lastname'];
        $investor->phone = $data['phone'];
        $investor->gender = $data['gender'];
        // $investor->profile_img = $data['profile_img'];
        $investor->date_of_birth = $data['date_of_birth'];
        $investor->nationality = $data['nationality'];
        $investor->address = $data['address'];
        
        
        if ($investor->save()) {
            return $profile;
        } else {
            return false;
        }
    }


    public function updateTrader($profile, $data)
    {
        $this->updateEmail($profile, $data['email']);

        $trader = Trader::find($profile->profileable_id);
        $trader->firstname = $data['firstname'];
        $trader->lastname = $data['lastname'];
        $trader->phone = $data['phone'];
        $trader->gender = $data['gender'];
        $trader->date_of_birth = $data['date_of_birth'];
        // $trader->profile_img = $data['profile_img'];
        $trader->nationality = $data['nationality'];
        $trader->percentage = $data['percentage'];
        $trader->expertise = $data['expertise'];
        $trader->show_admin_rating = $data['show_admin_rating'] == '1' ? true : false;
        $trader->admin_rating = $data['admin_rating'];
        $trader->liquidity = $data['liquidity'];
        $trader->liquidity_amt = $data['liquidity_amt'];
        
        
        if ($trader->save()) {
            return $profile;
        } else {
            return false;
        }
    }


    private function updateEmail($profile, $email)
    {
        if ($email !== $profile->email) {
            $profile->email = $email;
            $profile->email_verified_at = null;
            $profile->save();
        }
    }


    public function approveKYC($profile) 
    { 
        $profile->kyc->status = 'approved'; 
        
        $data = [
            'name' => $profile->profileable->firstname,
            'action' => 'approved',
            'reason' => ''
        ];

        
        if ($profile->kyc->save()) { 
            Mail::to($profile->email)->send(new AdminKycMail($data));
            return true; 
        } 
    } 


    public function rejectKYC($profile, $reason) 
    { 
        $profile->kyc->status = 'rejected'; 
        $profile->kyc->reason = $reason; 
        
        $data = [
            'name' => $profile->profileable->firstname,
            'action' => 'rejected',
            'reason' => $reason
        ];
        
        if ($profile->kyc->save()) { 
            Mail::to($profile->email)->send(new AdminKycMail($data));

            return true; 
        } 
    } 

    public function schedule($data)
    {
        $newMeeting = MeetingVerification::create($data);
        if ($newMeeting) {
            $trader = Trader::find($data['trader_id']);
            $data['name'] = $trader->firstname;
            Mail::to($trader->profile->email)->send(new MeetingMail($data));
            return true;
        } else {
            return false;
        }
    }


    public function conclude($meeting) 
    { 
        $meeting->status = 'successful'; 
        if ($meeting->save()) { 
            $trader = Trader::find($meeting->trader_id);

            $data = [ 
                'name' => $trader->firstname, 
                'action' => 'successful', 
            ]; 

            Mail::to($trader->profile->email)->send(new MeetingStatusMail($data)); 
            return true; 
        } else { 
            return false; 
        } 
    } 


    public function cancel($meeting)
    {
        $meeting->status = 'cancelled';
        if ($meeting->save()) {
            $trader = Trader::find($meeting->trader_id);

            $data = [ 
                'name' => $trader->firstname, 
                'action' => 'cancelled', 
            ]; 

            Mail::to($trader->profile->email)->send(new MeetingStatusMail($data)); 
            return true;
        } else {
            return false;
        }
    }

}