<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\Investor;
use App\Models\Trader;
use App\Models\Admin;
use App\Models\CompanyInfo;
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


        $sum_investment = Investment::where('status', 'completed')
                                        ->orWhere('status', 'accepted')
                                        ->orWhere('status', 'running')
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->sum('amount');

        $sum_withdrawals = Withdrawal::where('status', 'approved')
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->sum('amount');

                                                                         
        $total_investment = Investment::where('status', 'completed')
                                                ->orWhere('status', 'accepted')
                                                ->orWhere('status', 'running')
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->whereYear('created_at', Carbon::now()->year)
                                                ->count();

                
        $total_withdrawals = Withdrawal::where('status', 'approved') 
                                        ->whereMonth('created_at', Carbon::now()->month) 
                                        ->whereYear('created_at', Carbon::now()->year) 
                                        ->count(); 

        $investors_count = Investor::count(); 
        $traders_count = Trader::count(); 
        $admins_count = Admin::count(); 


        $investors = Investor::orderBy('created_at', 'DESC')->limit(5)->get();
        $traders = Trader::orderBy('created_at', 'DESC')->limit(5)->get();


        $company = CompanyInfo::first();
        $wallet_balance = $company ? $company->wallet_balance : 0;


        $investments = Investment::orderBy('created_at', 'DESC')->limit(5)->get();


        return view('v1.admin.home', 
                        compact(
                            'sum_investment', 'sum_withdrawals', 'total_investment', 
                            'total_withdrawals', 'investors', 'traders', 'admins_count', 
                            'wallet_balance', 'investments', 'investors_count', 
                            'traders_count')); 
    }


}
