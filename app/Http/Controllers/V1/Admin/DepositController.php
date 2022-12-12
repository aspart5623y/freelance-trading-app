<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Repository\Admin\DepositRepository;

class DepositController extends Controller
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
        $deposits = Deposit::all();
        return view('v1.admin.deposit', compact('deposits'));
    }


    public function approve(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $depositRepository = new DepositRepository;
        $approve = $depositRepository->approve($request->id);
        if ($approve) {
            return back()->with('success', 'You have approved this deposit.');
        } else {
            return back()->with('error', 'An unexpected error occured.');
        }
    }


    public function reject(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $depositRepository = new DepositRepository;
        $reject = $depositRepository->reject($request->id);
        if ($reject) {
            return back()->with('success', 'You have rejected this deposit.');
        } else {
            return back()->with('error', 'An unexpected error occured.');
        }
    }
}
