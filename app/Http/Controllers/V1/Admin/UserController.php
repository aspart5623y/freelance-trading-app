<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Trader;
use App\Models\MeetingVerification;
use App\Models\Investor;
use App\Models\Profile;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Requests\Admin\UpdateInvestorRequest;
use App\Http\Requests\MeetingLinkRequest;
use App\Http\Requests\Admin\UpdateTraderRequest;
use App\Repository\Admin\UserRepository;
use Monarobase\CountryList\CountryListFacade;


class UserController extends Controller
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

    
    public function investors()
    {
        $investors = Investor::latest()->get();
        return view('v1.admin.investors', compact('investors'));
    }


    public function traders()
    {
        $traders = Trader::latest()->get();
        return view('v1.admin.traders', compact('traders'));
    }


    public function admins()
    {
        $admins = Admin::latest()->get();
        return view('v1.admin.admins', compact('admins'));
    }

    
    public function show(Profile $profile)
    {
        $countries = CountryListFacade::getList('en');

        return view('v1.admin.show-user', compact('profile', 'countries'));
    }



    public function packages(Profile $profile) 
    { 
        if ($profile->profileable_type == "trader") { 
            $packages = $profile->profileable->packages; 
            return view('v1.admin.packages', compact('profile', 'packages')); 
        } 
    } 


    public function createAdmin(UpdateAdminRequest $request)
    {
        $userRepository = new UserRepository;
        $createAdmin = $userRepository->createAdmin($request->all());

        if($createAdmin) {
            return back()->with('success', 'You have successfully created a new admin profile.');
        } else {
            return back();
        }
    }


    public function updateAdmin(Profile $profile, UpdateAdminRequest $request)
    {
        $userRepository = new UserRepository;
        $_user = $userRepository->updateAdmin($profile, $request->all());

        if($_user) {
            return back()->with('success', 'You have successfully updated ' . $_user->profileable->firstname . ' ' . $_user->profileable->lastname . '\'s profile.');
        } else {
            return back();
        }
    }



    public function updateInvestor(Profile $profile, UpdateInvestorRequest $request)
    {
        $userRepository = new UserRepository;
        $_user = $userRepository->updateInvestor($profile, $request->all());
        
        if($_user) {
            return back()->with('success', 'You have successfully updated ' . $_user->profileable->firstname . ' ' . $_user->profileable->lastname . '\'s profile.');
        } else {
            return back();
        }
    }


    public function updateTrader(Profile $profile, UpdateTraderRequest $request)
    {
        $userRepository = new UserRepository;
        $_user = $userRepository->updateTrader($profile, $request->all());
        
        if($_user) {
            return back()->with('success', 'You have successfully updated ' . $_user->profileable->firstname . ' ' . $_user->profileable->lastname . '\'s profile.');
        } else {
            return back();
        }
    }



    public function verifyTrader(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $userRepository = new UserRepository;
        $_user = $userRepository->verifyTrader($request->user_id);
        
        if($_user->verify) {
            return back()->with('success', 'You have verified ' . $_user->firstname . ' ' . $_user->lastname . '\' account');
        } else {
            return back();
        }
    }



    public function disable(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $userRepository = new UserRepository;
        $_user = $userRepository->disable($request->user_id);
        
        if($_user->blocked) {
            return back()->with('success', 'You have blocked ' . $_user->profileable->firstname . ' ' . $_user->profileable->lastname);
        } else {
            return back()->with('success', 'You have unblocked ' . $_user->profileable->firstname . ' ' . $_user->profileable->lastname);
        }
    }



    public function deleteAccount(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'type' => 'required',
        ]);

        $userRepository = new UserRepository;
        $_user = $userRepository->delete($request->user_id);
        
        if($request->type == 'admin') {
            return redirect()->route('admin.admins')
                            ->with('success', 'Account deleted successfully');
        } else if($request->type == 'investor') {
            return redirect()->route('admin.investors')
                            ->with('success', 'Account deleted successfully');
        } else if($request->type == 'trader') {
            return redirect()->route('admin.traders')
                            ->with('success', 'Account deleted successfully');
        } else {
            return back();
        }
    }



    public function approveKYC(Profile $profile)
    {
        $userRepository = new UserRepository;
        $status = $userRepository->approveKYC($profile);

        if($status) {
            return back()->with('success', 'You have approved ' . $profile->profileable->firstname . '\'s KYC.');
        } else {
            return back();
        }
    }



    public function rejectKYC(Request $request, Profile $profile)
    {
        $request->validate([
            'reason' => 'required|max:255',
        ]);

        $userRepository = new UserRepository;
        $status = $userRepository->rejectKYC($profile, $request->reason);

        if($status) {
            return back()->with('success', 'You have rejected ' . $profile->profileable->firstname . '\'s KYC.');
        } else {
            return back();
        }
    }


    public function sendMeetingLink(MeetingLinkRequest $request)
    {
        $userRepository = new UserRepository;
        $trader = Trader::find($request->trader_id);
        $newMeeting = $userRepository->schedule($request->all());

        if ($newMeeting) {
            return back()->with("success", "You have successfully scheduled a meeting and an meeting initation mail has been sent to $trader->firstname $trader->lastname.");
        } else {
            return back();
        }
    }


    public function doneMeeting(Trader $trader, MeetingVerification $meeting)
    {
        $userRepository = new UserRepository;
        $newMeeting = $userRepository->conclude($meeting);

        if ($newMeeting) {
            return back()->with("success", "You have successfully concluded your meeting with $trader->firstname $trader->lastname.");
        } else {
            return back();
        }
    }


    public function cancelMeeting(Trader $trader, MeetingVerification $meeting)
    {
        $userRepository = new UserRepository;
        $newMeeting = $userRepository->cancel($meeting);

        if ($newMeeting) {
            return back()->with("success", "You have successfully cancelled your meeting with $trader->firstname $trader->lastname.");
        } else {
            return back();
        }
    }

}
