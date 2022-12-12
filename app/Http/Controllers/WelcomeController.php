<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class WelcomeController extends Controller
{
    public function index()
    {
        $traders = [];
        $profiles = Profile::where('blocked', false)->where('profileable_type', 'trader')->get();
        
        foreach($profiles as $profile) {
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


            if ($complete_profile) {
                // if ($complete_profile && $complete_kyc && $complete_meeting) {
                array_push($traders, $profile->profileable);
            }
            
        }

        return view('welcome', compact('traders')); 
    }
}
