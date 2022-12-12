<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Admin\AccountRepository;
use App\Http\Requests\FundRequest;
use App\Http\Requests\CryptoRequest;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\CompanyInfo;
use App\Models\Transaction;



class AccountController extends Controller
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


    public function transfer()
    {
        $transfers = Transaction::where('profile_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('v1.admin.transfer-fund', compact('transfers'));
    }


    public function transferFund(FundRequest $request)
    {
        $accountRepository = new AccountRepository;
        $transfer = $accountRepository->transferFund($request->all());
        if ($transfer['status']) {
            return back()->with('success', $transfer['message']);
        } else {
            return back()->with('error', $transfer['message']);
        }
    }

    public function companyInfo() {
        $company = CompanyInfo::first();
        return view('v1.admin.company-profile', compact('company'));
    }

    
    public function updateCompanyInfo(CompanyRequest $request) {
        $accountRepository = new AccountRepository;
        $company = $accountRepository->companyInfo($request->all());
        if ($company) {
            return back()->with('success', 'Company information has been updated successfully');
        } else {
            return back();
        }
    }

    
    public function accountInfo() {
        $accounts = auth()->user()->account;
        return view('v1.admin.crypto-account', compact('accounts'));
    }

    
    public function updateAccountInfo(CryptoRequest $request) {

        if (auth()->user()->profileable->level == "admin") {
            $accountRepository = new AccountRepository;
            $account = $accountRepository->accountInfo($request->all());
            if ($account) {
                return back()->with('success', 'Account information has been updated successfully');
            } else {
                return back();
            }
        } else {
            return back()->with('error', 'Unauthorized access. You cannot perform this operation');
        }
    }


    public function destroy(Request $request)
    {
        $request->validate([ 
            'id' => 'required', 
        ]); 

        if (auth()->user()->profileable->level == "admin") { 

            $accountRepository = new AccountRepository; 
            $delete = $accountRepository->delete($request->id); 
            if ($delete) { 
                return back()->with('success', 'You have successfully deleted an account.'); 
            } else { 
                return back(); 
            } 
        } else { 
            return back()->with('error', 'Unauthorized access. You cannot perform this operation'); 
        } 
    }
    

    
}
