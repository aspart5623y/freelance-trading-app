<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Withdrawal;
use Carbon\Carbon;

class HomeController extends Controller
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

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
         
        $complete_kyc = auth()->user()->kyc && auth()->user()->kyc->status == 'approved' ? true : false;

        $complete_meeting = auth()->user()->profileable->meetingVerification && auth()->user()->profileable->meetingVerification->status == 'successful' ? true : false;

        $packages = auth()->user()->profileable->packages()->orderBy('created_at', 'DESC')->limit(2)->get();


        $investments = Investment::where('trader_id', auth()->user()->profileable->id) 
                                    ->where('status', '!=', 'cancelled')
                                    ->orderBy('created_at', 'DESC') 
                                    ->limit(5)
                                    ->get(); 

        $sum_investment = auth()->user()->profileable->success_investments() 
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->sum('amount');
                                        
        $this_month_investment = auth()->user()->profileable->success_investments() 
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->count();
    
                                        
        $total_withdrawals = Withdrawal::where('profile_id', auth()->user()->id)
                                        ->where(function($query)
                                            {
                                                $query->where('status', 'approved')
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->whereYear('created_at', Carbon::now()->year);
                                            })->count(); 

        $sum_withdrawals = Withdrawal::where('profile_id', auth()->user()->id)
                                        ->where(function($query)
                                        {
                                            $query->where('status', 'approved')
                                            ->whereMonth('created_at', Carbon::now()->month)
                                            ->whereYear('created_at', Carbon::now()->year);
                                        })->sum('amount');
    

        return view('v1.trader.home', compact(
                                            'complete_profile', 'complete_kyc', 'complete_meeting', 
                                            'packages', 'investments', 'sum_investment', 'this_month_investment', 
                                            'total_withdrawals', 'sum_withdrawals'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
