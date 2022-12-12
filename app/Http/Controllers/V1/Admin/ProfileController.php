<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminProfileRequest;
use App\Repository\AdminProfileRepository;


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
        return view('v1.admin.profile');
    }


    public function update(AdminProfileRequest $request)
    {
        $adminProfileRepository = new AdminProfileRepository;
        $update = $adminProfileRepository->update($request->all());

        if ($update) {
            return back()->with('success', 'Your profile has been updated successfully');
        }
    }

    public function disable()
    {
        $adminProfileRepository = new AdminProfileRepository;
        $disable = $adminProfileRepository->disable();
        if ($disable) {
            session()->flush();
            auth()->logout();
            return redirect('login')->with('error', 'Your account has been disabled. Please contact your admin for any help');
        }
    }

    
}
