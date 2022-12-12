<?php

namespace App\Repository;

use App\Models\Withdrawal;
use App\Models\Wallet;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalRequestMail;

class WithdrawalRepository {
    
    public function create($data)
    {
        $wallet = auth()->user()->profileable->wallet_balance;
        if ($wallet > $data['amount']) { 
            if (Withdrawal::create($data)) { 
                Mail::to(auth()->user()->email)->send(new WithdrawalRequestMail(auth()->user()->profileable->firstname));
                return true;
            }
        } else {
            return false;
        }
    }

}