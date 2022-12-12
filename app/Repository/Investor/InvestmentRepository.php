<?php

namespace App\Repository\Investor;

use App\Models\Investment;
use App\Models\Investor;


class InvestmentRepository { 

    public function store($data) 
    { 
        $investor = Investor::find(auth()->user()->profileable->id); 

        if ($investor && $investor->wallet_balance >= $data['amount']) { 
            $invest = Investment::create($data); 
            return $invest ? ['status' => true, 'message' => 'Investment successful'] : ['status' => false, 'message' => 'An unexpected error occured']; 
        } else { 
            return ['status' => false, 'message' => 'Insufficient Balance. Please fund your wallet to proceed.']; 
        } 
    } 


    public function cancel($data)
    {
        $investment = Investment::find($data['id']);
        $investment->status = 'cancelled';
        return $investment->save() ? true : false;
    }

}