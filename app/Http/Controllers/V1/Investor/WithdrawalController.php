<?php

namespace App\Http\Controllers\V1\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Http\Requests\WithdrawalRequest;
use App\Repository\WithdrawalRepository;



class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::where('profile_id', auth()->user()->id)
                                    ->orderBy('created_at', 'DESC') 
                                    ->get(); 
                                    
        return view('v1.investor.withdrawal', compact('withdrawals'));
    }


    public function create()
    {
        return view('v1.investor.withdrawal-request');
    }


    public function store(WithdrawalRequest $request)
    {
        $withdrawalRepository = new WithdrawalRepository;
        $create = $withdrawalRepository->create($request->all());
        if ($create) {
            session()->flash('success', 'You have successfully requested a withdrawal.');
            return redirect()->route('investor.withdrawal');
        } else {
            session()->flash('error', 'You do not have sufficient funds for withdrawal.');
            return back();
        }
    }
}
