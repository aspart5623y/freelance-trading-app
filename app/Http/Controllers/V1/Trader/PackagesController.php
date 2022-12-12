<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Trader\PackagesRequest;
use App\Repository\Trader\PackagesRepository;
use App\Models\Service;
use App\Models\Package;

class PackagesController extends Controller
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
        $packages = auth()->user()->profileable->packages;
        return view('v1.trader.packages', compact('packages'));
    }


    public function create()
    {
        $services = Service::all();
        return view('v1.trader.add-package', compact('services'));
    }

    public function store(PackagesRequest $request)
    {
        $packagesRepository = new PackagesRepository;
        $create = $packagesRepository->create($request->all());
        if($create) {
            return redirect()->route('trader.packages')->with('success', 'You have successfully created a package.');
        } else {
            return back();
        }
    }

    public function edit(Package $package)
    {
        $services = Service::all();
        return view('v1.trader.edit-package', compact('services', 'package'));
    }

    public function update(PackagesRequest $request, Package $package)
    {
        $packagesRepository = new PackagesRepository;
        $update = $packagesRepository->update($request->all(), $package);
        if($update) {
            return redirect()->route('trader.packages')->with('success', 'You have successfully updated a package.');
        } else {
            return back();
        }
    }



    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);


        $packagesRepository = new PackagesRepository;
        $delete = $packagesRepository->delete($request->id);
        if ($delete) {
            return back()->with('success', 'You have successfully deleted a package.');
        } else {
            return back();
        }
    }
}
