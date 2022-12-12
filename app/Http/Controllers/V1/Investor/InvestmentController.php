<?php

namespace App\Http\Controllers\V1\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Investor\InvestmentRequest;
use App\Repository\Investor\InvestmentRepository;
use App\Models\Investment;


class InvestmentController extends Controller
{

    public function index()
    { 
        $investments = Investment::where('investor_id', auth()->user()->profileable->id) 
                                    ->orderBy('created_at', 'DESC') 
                                    ->get(); 

        return view('v1.investor.investments', compact('investments'));
    }


    public function store(InvestmentRequest $request)
    {
        $investmentRepository = new InvestmentRepository;
        $invest = $investmentRepository->store($request->all());
        if($invest['status']) {
            return redirect()->route('investor.investment.index')
                                ->with('success', 'You have successfully invested in this package.');
        } else {
            return back()->with('error', $invest['message']);
        }
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $investmentRepository = new InvestmentRepository;
        $cancel = $investmentRepository->cancel($request->all());
        if($cancel) {
            return back()->with('success', 'You have successfully cancelled this investment.');
        } else {
            return back()->with('error', 'An error occured');
        }
    }

}
