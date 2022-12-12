<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Investment;
use App\Models\Earning;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TransferApiController extends Controller
{

    public function apiGetName(Profile $profile)
    {
        return response()->json(['name' => $profile->profileable->firstname .' '. $profile->profileable->lastname], 200);
    }




    public function checkPin(Request $request)
    {

        if (auth()->user()->profileable->pin !== null) {
            if (Hash::check($request->get('pin'), auth()->user()->profileable->pin)) {
                return response()->json([
                    "status" => true
                ], 200);
            } 

            return response()->json([
                "status" => false,
                "type" => "error",
                "message" => "incorrect pin"
            ], 200);
        } 

        return response()->json([
            "status" => false,
            "type" => "pin",
            "message" => "Please set a transaction pin for your account "
        ], 200);
    }


    public function showInvestment(Investment $investment)
    {

        $investment->package_title = $investment->package->title;
        $investment->duration = $investment->package->duration;
        $investment->daily_return = round(($investment->amount * ($investment->package->roi/100))/$investment->package->duration, 2);
        $investment->profit = round($investment->amount * ($investment->package->roi/100), 2);
        $investment->requested_date = Carbon::create($investment->created_at)->format('l jS \of F Y');
        $investment->start_date = Carbon::create($investment->updated_at)->format('l jS \of F Y');
        $investment->end_date = Carbon::create($investment->updated_at)->addDays($investment->package->duration)->format('l jS \of F Y');
        $investment->trader_profile_id = $investment->trader->profile->id;
        $investment->trader_name = $investment->trader->firstname . ' ' . $investment->trader->lastname;
        $investment->investor_profile_id = $investment->investor->profile->id;
        $investment->investor_name = $investment->investor->firstname . ' ' . $investment->investor->lastname;


        $earnings = Earning::where('investment_id', $investment->id)->get();

        return response()->json(['investment' => $investment, 'earnings' => $earnings], 200);

    }
}