<?php

namespace App\Http\Controllers\V1\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Service;
use App\Models\Package;
use App\Models\Trader;
use App\Models\Profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        $profiles = Profile::where('blocked', false)->where('profileable_type', 'trader')->get();
        $traders = [];
        $packages_array = [];

        foreach($profiles as $profile){
            if (
                ($profile->profileable->gender == '' || $profile->profileable->gender == null) ||
                ($profile->profileable->phone == '' || $profile->profileable->phone == null) ||
                ($profile->profileable->date_of_birth == '' || $profile->profileable->date_of_birth == null) ||
                ($profile->profileable->nationality == '' || $profile->profileable->nationality == null) ||
                ($profile->profileable->profile_img == '' || $profile->profileable->profile_img == null) ||
                ($profile->profileable->expertise == '' || $profile->profileable->expertise == null) ||
                ($profile->profileable->percentage == '' || $profile->profileable->percentage == null) ||
                ($profile->profileable->liquidity == '' || $profile->profileable->liquidity == null) ||
                ($profile->profileable->liquidity_amt == '' || $profile->profileable->liquidity_amt == null)
            ) {
                $complete_profile = false;
            } else {
                $complete_profile = true;
            }
             
            $complete_kyc = $profile->kyc && $profile->kyc->status == 'approved' ? true : false;
    
            $complete_meeting = $profile->profileable->meetingVerification && $profile->profileable->meetingVerification->status == 'successful' ? true : false;
    

            if ($complete_profile && $complete_kyc && $complete_meeting) {
                array_push($traders, $profile->profileable);
                array_push($packages_array, $profile->profileable->packages->toArray());
            }
        }
        
        
        $all_packages = Arr::collapse($packages_array);
        $packages = [];
        
        foreach($all_packages as $package) {
            $service = Service::find($package['service_id']);
            $package['service_title'] = $service->title;
            $package['service_color'] = $service->color;
            array_push($packages, $package);
        }


        return view('v1.investor.home', compact('services', 'packages', 'traders'));
    }

}
