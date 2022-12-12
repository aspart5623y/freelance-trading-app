<?php

namespace App\Repository\Investor;

use App\Models\Profile;
use App\Models\Investor;
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
        $profile = Investor::find(auth()->user()->profileable_id);
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
        $user = Investor::find($profile->profileable->id); 

        if ($user->delete()) {
            $profile->delete();
            return true;
        } else {
            return false;
        }
    }

}