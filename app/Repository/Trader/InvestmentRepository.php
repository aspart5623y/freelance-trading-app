<?php

namespace App\Repository\Trader;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Trader;


class InvestmentRepository { 

   
    public function update($data)
    {
        $investment = Investment::find($data['id']);
        $investment->status = $data['status'];

        if ($data['status'] == 'accepted') {
            $investor = Investor::find($investment->investor_id);
            $trader = Trader::find($investment->trader_id);

            if ($investor->wallet_balance >= $investment->amount) {
                $investor->wallet_balance -= $investment->amount;
                $trader->wallet_balance += $investment->amount;
                $investor->save();
                $trader->save();
            } else {
                return false;
            }
        }

        return $investment->save() ? true : false;
    }

}