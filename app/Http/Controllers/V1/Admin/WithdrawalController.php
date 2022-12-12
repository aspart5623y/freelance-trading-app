<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Repository\Admin\WithdrawalRepository;


class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::all();
        return view('v1.admin.withdrawal', compact('withdrawals'));
    }


    public function approve(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $withdrawalRepository = new WithdrawalRepository;
        $approve = $withdrawalRepository->approve($request->id);
        if ($approve) {
            return back()->with('success', 'You have approved this withdrawal.');
        } else {
            return back()->with('error', 'An unexpected error occured.');
        }
    }


    public function reject(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $withdrawalRepository = new WithdrawalRepository;
        $reject = $withdrawalRepository->reject($request->id);
        if ($reject) {
            return back()->with('success', 'You have rejected this withdrawal.');
        } else {
            return back()->with('error', 'An unexpected error occured.');
        }
    }
    

}
