<?php

namespace App\Repository\Trader;

use App\Models\Profile;
use App\Models\Trader;
use Illuminate\Support\Facades\Hash;


class SettingsRepository {

    public function password($data)
    {
        $profile = Profile::find(auth()->user()->id);
        $profile->password = Hash::make($data['new_password']);
        if ($profile->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function pin($data)
    {
        $profile = Trader::find(auth()->user()->profileable_id);
        $profile->pin = Hash::make($data['pin']);
        if ($profile->save()) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($data)
    {
        $profile = Profile::find($data);
        $user = Trader::find($profile->profileable->id); 

        if ($user->delete()) {
            $profile->delete();
            return true;
        } else {
            return false;
        }
    }

}