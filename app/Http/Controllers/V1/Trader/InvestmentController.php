<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Trader\InvestmentRepository;
use App\Models\Investment;


class InvestmentController extends Controller
{
    public function index()
    { 
        $investments = Investment::where('trader_id', auth()->user()->profileable->id) 
                                    ->where('status', '!=', 'cancelled')
                                    ->orderBy('created_at', 'DESC') 
                                    ->get(); 

        return view('v1.trader.investments', compact('investments'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $investmentRepository = new InvestmentRepository;
        $update = $investmentRepository->update($request->all());
        if($update) {
            return back()->with('success', 'You have successfully updated this investment status.');
        } else {
            return back()->with('error', 'An error occured. Maybe the investor do not have enough funds for this trade.');
        }
    }
}
