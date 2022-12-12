<?php

namespace App\Repository;
use App\Models\Trader;
use App\Models\Investor;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterationMail;
use App\Mail\TraderRegisterationMail;


class RegisterRepository {
    
    public function create($data)
    {
        if ($data['account_type'] === 'investor') {
            
            $investor = Investor::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
            ]);

            $investor->profile()->create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            Mail::to($data['email'])->send(new RegisterationMail());

            return true;

        } else if ($data['account_type'] === 'trader') {
            
            $trader = Trader::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
            ]);

            $trader->profile()->create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            Mail::to($data['email'])->send(new TraderRegisterationMail());


            return true;

        } 

        return false;
    }


    public function password($data)
    {
        $profile = Profile::where('email', $data['email'])->first();
        $profile->password = Hash::make($data['password']);

        if ($profile->save()) {
            return true;
        } else {
            return false;
        }
    }

}