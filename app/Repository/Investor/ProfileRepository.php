<?php

namespace App\Repository\Investor;

use App\Models\Profile;
use App\Models\Investor;
use Illuminate\Support\Facsades\Mail;
use App\Mail\KycMail;

class ProfileRepository {
    public function update($data)
    {
        if ($data['email'] !== auth()->user()->email) {
            $profile = Profile::find(auth()->user()->id);
            $profile->email = $data['email'];
            $profile->email_verified_at = null;
            $profile->save();
        }

        $investor = Investor::find(auth()->user()->profileable_id);
        $investor->firstname = $data['firstname'];
        $investor->lastname = $data['lastname'];
        $investor->phone = $data['phone'];
        $investor->gender = $data['gender'];
        $investor->date_of_birth = $data['date_of_birth'];
        $investor->nationality = $data['nationality'];
        $investor->address = $data['address'];
        
        
        if ($investor->save()) {
            return true;
        } else {
            return false;
        }
    }



    public function kyc($data) 
    { 
        $profile = Profile::find(auth()->user()->id); 

        if ($profile->kyc) {
            $this->deleteFile($profile->kyc->front_view, 'kyc/front_view'); 
            $this->deleteFile($profile->kyc->rear_view, 'kyc/rear_view'); 
        }

        $data['front_view'] = $this->saveFile($data['front_view'], 'front_view'); 
        $data['rear_view'] = $this->saveFile($data['rear_view'], 'rear_view'); 

        
        array_shift($data); 
        
        if ($profile->kyc) {
            $data['status'] = 'pending';
            $data['reason'] = '';
            $kyc = $profile->kyc()->update($data);
        } else {
            $kyc = $profile->kyc()->create($data);
        }

        
        if ($kyc) { 
            Mail::to($profile->email)->send(new KycMail($profile->profileable->firstname));
            return true; 
        } else { 
            return false; 
        } 
    }
    


    public function image($data)
    {
        $profile = Investor::find(auth()->user()->profileable_id); 

        if ($profile->profile_img) {
            $this->deleteFile($profile->profile_img, 'profile-image/investor'); 
        }

        $image = $this->saveFile($data['image'], 'profile-image/investor'); 

        $profile->profile_img = $image;

        if ($profile->save()) { 
            return true; 
        } else { 
            return false; 
        } 
    }

   
    private function saveFile($file, $path)
    {
        $fileName = auth()->user()->profileable->firstname . time() . '.' . $file->extension();
        if ($path == 'front_view') {
            $file->move(public_path('kyc/front_view'), $fileName);
        } elseif ($path == 'rear_view') {
            $file->move(public_path('kyc/rear_view'), $fileName);
        } elseif ($path == 'profile-image/investor') {
            $file->move(public_path('profile-image/investor'), $fileName);
        }

        return $fileName;
    }


    private function deleteFile($fileName, $path)
    {
        unlink(public_path($path) . '/' . $fileName);
    }

}