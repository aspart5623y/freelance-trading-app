<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades;
use App\Http\Requests\LoginRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Repository\RegisterRepository;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(LoginRequest $request)
    {
        $profile = Profile::where('email', $request->email)->first();
        
        if ($profile->password == null) {
            return redirect()->route('password.new', ['email' => $request->email]);
        } else {
            return $this->authenticate($request->all());
        }
    } 


    public function setPassword($email)
    {
        return view('auth.set-password', compact('email'));
    }


    public function savePassword(Request $request)
    {
        $request->validate([
            "password" => "required|string|alpha_dash|min:8|confirmed",
        ]);

        $registerRepository = new RegisterRepository;
        $createPassword = $registerRepository->password($request->all());

        if ($createPassword) {
            return $this->authenticate($request->all());
        } else {
            return back()->with('error', 'An unexpected error occured. Please try again'); 
        }
    }


    private function authenticate($data)
    {
        if(auth()->attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            if (auth()->user()->profileable_type == 'admin') {
                return redirect()->route('admin.home')
                        ->with('success','You have successfully logged into the admin dashboard.');
            } else if (auth()->user()->profileable_type == 'trader') {
                    $complete_profile = null;

                    if (
                        (auth()->user()->profileable->gender == '' || auth()->user()->profileable->gender == null) ||
                        (auth()->user()->profileable->phone == '' || auth()->user()->profileable->phone == null) ||
                        (auth()->user()->profileable->date_of_birth == '' || auth()->user()->profileable->date_of_birth == null) ||
                        (auth()->user()->profileable->nationality == '' || auth()->user()->profileable->nationality == null) ||
                        (auth()->user()->profileable->expertise == '' || auth()->user()->profileable->expertise == null) ||
                        (auth()->user()->profileable->percentage == '' || auth()->user()->profileable->percentage == null) ||
                        (auth()->user()->profileable->liquidity == '' || auth()->user()->profileable->liquidity == null) ||
                        (auth()->user()->profileable->liquidity_amt == '' || auth()->user()->profileable->liquidity_amt == null)
                    ) {
                        $complete_profile = false;
                    } else {
                        $complete_profile = true;
                    }

                if (!$complete_profile || !auth()->user()->kyc || !auth()->user()->profileable->verify) {
                    session()->flash('error', 
                                    'Your have not completed your profile, kyc verification and your account have not been verified by the admin. Please proceed to your profile to complete your verification so your packages can be visible to investors');
                } else {
                    session()->flash('success','You have successfully logged into the trader\'s dashboard.');
                }

                return redirect()->route('trader.home');
            } else if (auth()->user()->profileable_type == 'investor') {
                return redirect()->route('investor.home')
                        ->with('success','You have successfully logged into the investor\'s dashboard.');
            } 
        } else { 
            return back()->with('error','password is incorrect.'); 
        } 
    } 

} 