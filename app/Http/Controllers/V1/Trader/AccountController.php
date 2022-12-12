<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CryptoRequest;
use App\Http\Requests\PaypalRequest;
use App\Http\Requests\FundRequest;
use App\Http\Requests\BankRequest;
use App\Repository\Trader\AccountRepository;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Admin;



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

    
    public function bank()
    {
        $accounts = auth()->user()->account;
        return view('v1.trader.bank-account', compact('accounts'));
    }

    public function crypto()
    {
        $accounts = auth()->user()->account;
        return view('v1.trader.crypto-account', compact('accounts'));
    }

    public function paypal()
    {
        $accounts = auth()->user()->account;
        return view('v1.trader.paypal-account', compact('accounts'));
    }


    public function addBank(BankRequest $request)
    {
        $accountRepository = new AccountRepository;
        $create = $accountRepository->createBank($request->all());
        if ($create) {
            return back()->with('success', 'You have successfully added a bank account.');
        } else {
            return back();
        }
    }


    public function addCrypto(CryptoRequest $request)
    {
        $accountRepository = new AccountRepository;
        $create = $accountRepository->createCrypto($request->all());
        if ($create) {
            return back()->with('success', 'You have successfully added a crypto wallet.');
        } else {
            return back();
        }
    }


    public function addPaypal(PaypalRequest $request)
    {
        $accountRepository = new AccountRepository;
        $create = $accountRepository->createPaypal($request->all());
        if ($create) {
            return back()->with('success', 'You have successfully added a paypal account.');
        } else {
            return back();
        }
    }


    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);


        $accountRepository = new AccountRepository;
        $delete = $accountRepository->delete($request->id);
        if ($delete) {
            return back()->with('success', 'You have successfully deleted an account.');
        } else {
            return back();
        }
    }



    public function transfer()
    {
        $transfers = Transaction::where('profile_id', auth()->user()->id)->orWhere('reciever_address', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('v1.trader.transfer-fund', compact('transfers'));
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



    public function fund()
    {
        $admin = Admin::where('level', 'admin')->first();
        $accounts = $admin->profile->account;
        $deposits = auth()->user()->deposit;
        return view('v1.trader.fund-wallet', compact('accounts', 'deposits'));
    }


    public function fundWallet(Request $request)
    {
        $request->validate([
            'proof' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);



        $accountRepository = new AccountRepository;
        $save = $accountRepository->uploadProof($request->all());
        if ($save) {
            return redirect()->route('trader.fund.wallet')->with('success', 'You have successfully uploaded your proof of payment. Your account would be funded as soon as your payment is confirmed');
        } else {
            return back()->with('error', 'An unexpected error occured');
        }
    }


    public function walletTransfer(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'coin' => 'required'
        ]);

        return redirect()->route('trader.wallet.address', ['amount' => $request->amount, 'account' => $request->coin]);
    }

    public function walletAddress($amount, $account)
    {
        $account = Account::find($account);
        return view('v1.trader.wallet-address', compact('amount', 'account'));
    }
}
