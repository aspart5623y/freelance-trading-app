<?php

namespace App\Repository;

use App\Models\Profile;
use App\Models\Admin;


class AdminProfileRepository {

    public function update($data)
    {   
        $admin = Admin::find(auth()->user()->profileable_id);
        $admin->firstname = $data['firstname'];
        $admin->lastname = $data['lastname'];
        

        if ($admin->save()) {
            if ($data['email'] !== auth()->user()->email) {
                $profile = Profile::find(auth()->user()->id);
                $profile->email = $data['email'];
                $profile->email_verified_at = null;
                $profile->save();
            }
            return true;
        } else {
            return false;
        }
    }


    public function disable()
    {
        $profile = Profile::find(auth()->user()->id);
        $profile->blocked = true;
        if ($profile->save()) {
            return true;
        } else {
            return false;
        }
        
    }

}