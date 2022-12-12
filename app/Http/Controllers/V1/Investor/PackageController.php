<?php

namespace App\Http\Controllers\V1\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Service;

class PackageController extends Controller
{

    public function index()
    {
        $data = [
            'title' => '',
            'service_id' => '',
            'min_roi' => '',
            'max_roi' => '',
            'min_duration' => '',
            'max_duration' => '',
            'min_investment' => '',
            'max_investment' => '',
        ];

        $services = Service::all();
        $packages = Package::inRandomOrder()->paginate(6);
        return view('v1.investor.packages', compact('packages', 'services', 'data'));
    }

    public function services()
    {
        $services = Service::all();
        return view('v1.investor.services', compact('services'));
    }

    public function service(Service $service)
    {
        $data = [
            'title' => '',
            'service_id' => '',
            'min_roi' => '',
            'max_roi' => '',
            'min_duration' => '',
            'max_duration' => '',
            'min_investment' => '',
            'max_investment' => '',
        ];
        $packages = $service->packages()->inRandomOrder()->paginate(6);
        $services = Service::all();
        return view('v1.investor.packages', compact('packages', 'services', 'data'));
    }

    public function show(Package $package)
    {
        return view('v1.investor.package-view', compact('package'));
    }


    public function search(Request $request)
    {
        $packages = Package::query();


        $title = $request->title;
        $service_id = $request->service_id;
        $min_roi = $request->min_roi;
        $max_roi = $request->max_roi;
        $min_duration = $request->min_duration;
        $max_duration = $request->max_duration;
        $min_investment = $request->min_investment;
        $max_investment = $request->max_investment;



        if ($title) {
            $packages->where('title','LIKE','%'.$title.'%');
        }

        if ($service_id) {
            $packages->whereIn('service_id', $service_id);
        }

        if ($min_roi) {
            $packages->where('roi', '>=', (int)$min_roi);
        }

        if ($max_roi) {
            $packages->where('roi', '<=', (int)$max_roi);
        }

        if ($min_duration) {
            $packages->where('duration', '>=', (int)$min_duration);
        }

        if ($max_duration) {
            $packages->where('duration', '<=', (int)$max_duration);
        }

        if ($min_investment) {
            $packages->where('minimum_amount', '>=', (int)$min_investment);
        }

        if ($max_investment) {
            $packages->where('maximum_amount', '<=', (int)$max_investment);
        }


        $data = [
            'title' => $title,
            'service_id' => $service_id,
            'min_roi' => $min_roi,
            'max_roi' => $max_roi,
            'min_duration' => $min_duration,
            'max_duration' => $max_duration,
            'min_investment' => $min_investment,
            'max_investment' => $max_investment,
        ];

        $packages = $packages->paginate(6);
        $services = Service::all();


        return view('v1.investor.packages', compact('packages', 'data', 'services'));
    }


    


}
