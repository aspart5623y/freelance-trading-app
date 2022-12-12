<?php

namespace App\Repository\Admin;

use App\Models\Profile;
use App\Models\Admin;
use App\Models\Service;
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


    public function delete($data)
    {
        $profile = Profile::find($data);
        $user = Admin::find($profile->profileable->id); 

        if ($user->delete()) {
            $profile->delete();
            return true;
        } else {
            return false;
        }
    }


    public function saveService($data)
    {
        $service = Service::create($data);

        if ($service) {
            return true;
        } else {
            return false;
        }
    }

    public function updateService($service, $data)
    {
        if ($service->update($data)) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteService($data)
    {
        $service = Service::find($data);

        if ($service->delete()) {
            return true;
        } else {
            return false;
        }
        
    }



    public function pin($data)
    {
        $profile = Admin::find(auth()->user()->profileable_id);
        $profile->pin = Hash::make($data['pin']);
        if ($profile->save()) {
            return true;
        } else {
            return false;
        }
    }
}