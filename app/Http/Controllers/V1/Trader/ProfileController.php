<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Trader\UpdateProfileRequest;
use App\Http\Requests\KycRequest;
use App\Repository\Trader\ProfileRepository;
use App\Models\Profile;
use App\Models\Trader;
use App\Http\Requests\ImageRequest;
use Monarobase\CountryList\CountryListFacade;


class ProfileController extends Controller
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


    public function index()
    {
        $complete_profile = null;

        if (
            (auth()->user()->profileable->gender == '' || auth()->user()->profileable->gender == null) ||
            (auth()->user()->profileable->phone == '' || auth()->user()->profileable->phone == null) ||
            (auth()->user()->profileable->date_of_birth == '' || auth()->user()->profileable->date_of_birth == null) ||
            (auth()->user()->profileable->nationality == '' || auth()->user()->profileable->nationality == null) ||
            (auth()->user()->profileable->profile_img == '' || auth()->user()->profileable->profile_img == null) || 
            (auth()->user()->profileable->expertise == '' || auth()->user()->profileable->expertise == null) ||
            (auth()->user()->profileable->percentage == '' || auth()->user()->profileable->percentage == null) ||
            (auth()->user()->profileable->liquidity == '' || auth()->user()->profileable->liquidity == null) ||
            (auth()->user()->profileable->liquidity_amt == '' || auth()->user()->profileable->liquidity_amt == null)
        ) {
            $complete_profile = false;
        } else {
            $complete_profile = true;
        }

        
        $complete_kyc = auth()->user()->kyc && auth()->user()->kyc->status == 'approved' ? true : false;

        $complete_meeting = auth()->user()->profileable->meetingVerification && auth()->user()->profileable->meetingVerification->status == 'successful' ? true : false;

        $countries = CountryListFacade::getList('en');

        return view('v1.trader.profile', compact('complete_profile', 'complete_kyc', 'countries', 'complete_meeting'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $profileRepository = new ProfileRepository;
        $update = $profileRepository->update($request->all());
        if($update) {
            return back()->with('success', 'You have successfully updated your profile.');
        } else {
            return back();
        }
    }

    public function kycVerification(KycRequest $request)
    {
        $profileRepository = new ProfileRepository;
        $kyc = $profileRepository->kyc($request->all());
        if($kyc) {
            return back()->with('success', 'You have successfully uploaded your kyc document. Our admin will review it and get back to you on it.');
        } else {
            return back();
        }
    }
    
    
    public function image()
    {
        return view('v1.trader.profile-image');
    }

    public function updateImage(ImageRequest $request)
    {
        $profileRepository = new ProfileRepository;
        $image = $profileRepository->image($request->all());
        if($image) {
            session()->flash('success', 'You have successfully updated your profile image.');
            return redirect()->route('trader.profile');
        } else {
            return back();
        }
    }


}
