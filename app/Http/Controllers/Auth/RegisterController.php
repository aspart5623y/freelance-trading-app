<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Repository\RegisterRepository;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }


    public function submitType(Request $request)
    {
        $request->validate([
            'account_type' => 'required',
        ]);

        return $this->create($request->account_type);
    }


    public function create($type)
    {   
        return view('auth.register-2', compact('type'));
    }


    public function register(RegisterRequest $request)
    {
        $registerRepository = new RegisterRepository;
        $create = $registerRepository->create($request->all());
        if ($create) {
            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (auth()->user()->profileable_type == 'trader') {
                    return redirect()->route('trader.home');
                } else if (auth()->user()->profileable_type == 'investor') {
                    return redirect()->route('investor.home');
                }
            }
        
        }
    }
}
