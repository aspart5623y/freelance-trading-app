<?php

namespace App\Repository\Trader;

use App\Models\Package;
use App\Models\Trader;
use App\Models\Service;


class PackagesRepository {

    public function create($data)
    {
        $trader = auth()->user()->profileable;
        if ($trader) {
            if ($data['service'] == "other") {
                $service = Service::where('title', 'LIKE', '%' . $data['other'] . '%')->first();
                if ($service == null) {
                    $service = Service::create([
                        'title' => $data['other']
                    ]);
                }
            } else {
                $service = Service::find($data['service']);
            }
            
            if ($service) {
                $package = new Package();
                $package->service_id = $service->id;
                $package->title = $data['title'];
                $package->roi = $data['roi'];
                $package->duration = $data['duration'];
                $package->minimum_amount = $data['minimum_amount'];
                $package->maximum_amount = $data['maximum_amount'];
                $package->description = $data['description'];
          
                if ($trader->packages()->save($package)) {
                    return true;
                } 
            } 
        }

        return false;
    }




    public function update($data, $package)
    {
        $trader = auth()->user()->profileable;
        if ($trader) {
            if ($data['service'] == "other") {
                $service = Service::where('title', 'LIKE', '%' . $data['other'] . '%')->first();
                if ($service == null) {
                    $service = Service::create([
                        'title' => $data['other']
                    ]);
                }
            } else {
                $service = Service::find($data['service']);
            }
            
            if ($service) {
                $package->service_id = $service->id;
                $package->title = $data['title'];
                $package->roi = $data['roi'];
                $package->duration = $data['duration'];
                $package->minimum_amount = $data['minimum_amount'];
                $package->maximum_amount = $data['maximum_amount'];
                $package->description = $data['description'];
          
                if ($trader->packages()->save($package)) {
                    return true;
                } 
            } 
        }

        return false;
    }




    public function delete($data)
    {
        $package = Package::find($data);

        if ($package->delete()) {
            return true;
        } else {
            return false;
        }
    }
}