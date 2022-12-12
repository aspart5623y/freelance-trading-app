<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Admin\SettingsRepository;
use App\Http\Requests\CheckPasswordRequest;
use App\Http\Requests\PinRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;

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
        return view('v1.admin.settings');
    }

    public function password()
    {
        return view('v1.admin.password');
    }


    public function update(PasswordRequest $request)
    {
        $settingsRepository = new SettingsRepository;
        $update = $settingsRepository->password($request->all());
        if ($update) {
            session()->flash('success', 'You have successfully updated your account password.');
            return redirect()->route('admin.settings');
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
        }
    }


    public function service()
    {
        $services = Service::all();
        return view('v1.admin.services', compact('services'));
    }


    public function storeService(ServiceRequest $request)
    {
        $settingsRepository = new SettingsRepository;
        $create = $settingsRepository->saveService($request->all());
        if ($create) {
            return back()->with('success', 'You have successfully created a service.');
        }
    }

    public function editService(Service $service)
    {
        return view('v1.admin.edit-service', compact('service'));
    }


    public function updateService(Service $service, ServiceRequest $request)
    {
        $settingsRepository = new SettingsRepository;
        $create = $settingsRepository->updateService($service, $request->all());
        if ($create) {
            return redirect()->route('admin.service')->with('success', 'You have successfully updated '. $service->title .' service.');
        }
    }

    public function deleteService(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);


        $settingsRepository = new SettingsRepository;
        $delete = $settingsRepository->deleteService($request->id);
        if ($delete) {
            return back()->with('success', 'You have successfully deleted a service.');
        } else {
            return back();
        }
    }




    public function checkPassword()
    {
        return view('v1.admin.confirm-password');
    }

    public function confirmPassword(CheckPasswordRequest $request)
    {
        return redirect()->route('admin.pin');
    }

    public function pin()
    {
        return view('v1.admin.pin');
    }

    public function updatePin(PinRequest $request)
    {
        $settingsRepository = new SettingsRepository;
        $update = $settingsRepository->pin($request->all());
        if ($update) {
            session()->flash('success', 'You have successfully updated your transaction pin.');
            return redirect()->route('admin.settings');
        } else {
            return back();
        }
    }
}
