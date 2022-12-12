<?php

namespace App\Repository\Admin;

use App\Models\Deposit;
use App\Models\CompanyInfo;
use App\Models\Investor;
use App\Models\Trader;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositMail;

class DepositRepository {
    
    public function approve($data)
    {
        $companyInfo = CompanyInfo::first();


        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
        } 
        
        $wallet_balance = $companyInfo->wallet_balance;
        $deposit = Deposit::find($data);
        $user = $deposit->profile;
        $deposit->status = 'approved';

        $details = [
            'amount' => $deposit->amount,
            'action' => 'Approved'
        ];

        if ($deposit->save()) {
            $companyInfo->wallet_balance += $deposit->amount;
            if ($user->profileable_type == "trader") {
                $trader = Trader::find($user->profileable->id);
                $trader->wallet_balance +=  $deposit->amount;
                $trader->save();
                $details['name'] = $trader->firstname;
                $details['email'] = $trader->profile->email;
            } else if ($user->profileable_type == "investor") {
                $investor = Investor::find($user->profileable->id);
                $investor->wallet_balance +=  $deposit->amount;
                $investor->save();
                $details['name'] = $investor->firstname;
                $details['email'] = $investor->profile->email;
            }
            $companyInfo->save();

            Mail::to($details['email'])->send(new DepositMail($details)); 

            return true;
        }

        return false;
    }


    public function reject($data)
    {
        $deposit = Deposit::find($data);
        $deposit->status = 'rejected';

        $details = [ 
            'name' => $deposit->profile->profileable->firstname, 
            'amount' => $deposit->amount, 
            'action' => 'Rejected' 
        ]; 
        
        Mail::to($deposit->profile->email)->send(new DepositMail($details)); 

        if ($deposit->save()) {
            return true;
        } else {
            return false;
        }
    }

}