<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Trader\SettingsRepository;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\CheckPasswordRequest;
use App\Http\Requests\PinRequest;


class SettingsController extends Controller
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
        return view('v1.trader.settings');
    }

    public function password()
    {
        return view('v1.trader.password');
    }


    public function update(PasswordRequest $request)
    {
        $settingsRepository = new SettingsRepository;
        $update = $settingsRepository->password($request->all());
        if ($update) {
            session()->flash('success', 'You have successfully updated your account password.');
            return redirect()->route('trader.settings');
        } else {
            return back();
        }
    }


    public function destroy(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $settingsRepository = new SettingsRepository;
        $delete = $settingsRepository->delete($request->user_id);
        if ($delete) {
            session()->flush();
            auth()->logout();
            return redirect('login')->with('error', 'Your account has been deleted. You would have to create a new account to have access to this platform.');
        } else {
            return back();
        }
    
    }


    public function checkPassword()
    {
        return view('v1.trader.confirm-password');
    }

    public function confirmPassword(CheckPasswordRequest $request)
    {
        return redirect()->route('trader.pin');
    }

    public function pin()
    {
        return view('v1.trader.pin');
    }

    public function updatePin(PinRequest $request)
    {
        $settingsRepository = new SettingsRepository;
        $update = $settingsRepository->pin($request->all());
        if ($update) {
            session()->flash('success', 'You have successfully updated your transaction pin.');
            return redirect()->route('trader.settings');
        } else {
            return back();
        }
    }

}
