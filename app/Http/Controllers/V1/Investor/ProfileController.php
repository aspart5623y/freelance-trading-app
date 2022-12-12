<?php

namespace App\Http\Controllers\V1\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Investor\UpdateProfileRequest;
use App\Repository\Investor\ProfileRepository;
use App\Http\Requests\KycRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Investor;
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
            (auth()->user()->profileable->phone == '' || auth()->user()->profileable->phone == null) || 
            (auth()->user()->profileable->gender == '' || auth()->user()->profileable->gender == null) || 
            (auth()->user()->profileable->profile_img == '' || auth()->user()->profileable->profile_img == null) || 
            (auth()->user()->profileable->date_of_birth == '' || auth()->user()->profileable->date_of_birth == null) || 
            (auth()->user()->profileable->nationality == '' || auth()->user()->profileable->nationality == null) || 
            (auth()->user()->profileable->address == '' || auth()->user()->profileable->address == null) 
        ) { 
            $complete_profile = false; 
        } else { 
            $complete_profile = true; 
        } 

        
        $complete_kyc = auth()->user()->kyc && auth()->user()->kyc->status == 'approved' ? true : false;

        $countries = CountryListFacade::getList('en');
        

        return view('v1.investor.profile', compact('complete_profile', 'complete_kyc', 'countries'));
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
        return view('v1.investor.profile-image');
    }


    public function updateImage(ImageRequest $request)
    {
        $profileRepository = new ProfileRepository;
        $image = $profileRepository->image($request->all());
        if($image) {
            session()->flash('success', 'You have successfully updated your profile image.');
            return redirect()->route('investor.profile');
        } else {
            return back();
        }
    }


}
