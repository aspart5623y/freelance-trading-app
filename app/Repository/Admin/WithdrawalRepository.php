<?php

namespace App\Repository\Admin;

use App\Models\Withdrawal;
use App\Models\CompanyInfo;
use App\Models\Investor;
use App\Models\Trader;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalMail;

class WithdrawalRepository {
    
    public function approve($data)
    {
        $companyInfo = CompanyInfo::first();
        if ($companyInfo) {
            $wallet_balance = $companyInfo->wallet_balance;
            $withdrawal = Withdrawal::find($data);
            $user = $withdrawal->profile;

            if ($wallet_balance > $withdrawal->amount) {

                $withdrawal->status = 'approved';
                
                if ($withdrawal->save()) {
                    $companyInfo->wallet_balance -= $withdrawal->amount;
                    if ($user->profileable_type == "trader") {
                        $trader = Trader::find($user->profileable->id);
                        $trader->wallet_balance -=  $withdrawal->amount;
                        $trader->save();
                    } else if ($user->profileable_type == "investor") {
                        $investor = Investor::find($user->profileable->id);
                        $investor->wallet_balance -=  $withdrawal->amount;
                        $investor->save();
                    }

                    $companyInfo->save();

                    $details = [ 
                        'name' => $withdrawal->profile->profileable->firstname, 
                        'amount' => $withdrawal->amount, 
                        'action' => 'Approved' 
                    ]; 
                    
                    Mail::to($withdrawal->profile->email)->send(new WithdrawalMail($details)); 

                    return true;
                } else {
                    return false;
                } 

            } else {
                return false;
            }
        } 
        return false;
    }


    public function reject($data)
    {

        $withdrawal = Withdrawal::find($data);
        $withdrawal->status = 'rejected';
        
        $details = [ 
            'name' => $withdrawal->profile->profileable->firstname, 
            'amount' => $withdrawal->amount, 
            'action' => 'Rejected' 
        ]; 
        
        Mail::to($withdrawal->profile->email)->send(new WithdrawalMail($details)); 

        if ($withdrawal->save()) {
            return true;
        } else {
            return false;
        }
    }

}