<?php

namespace App\Repository\Admin;

use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Models\Trader;
use App\Models\Investor;
use App\Models\Transaction;
use App\Models\Profile;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransferFundsMail;
use App\Mail\RecieveFundsMail;

class AccountRepository {
    public function transferFund($data)
    {
        $recipient = Profile::find($data['address']);
        if ($recipient) {
            $sender = CompanyInfo::first();

            if ($sender && $sender->wallet_balance > $data['amount']) {
                $sender->wallet_balance -= $data['amount'];
                if ($sender->save()) {
                    if ($recipient->profileable_type == "trader") {
                        $reciever = Trader::find($recipient->profileable->id);
                    } else if ($recipient->profileable_type == "investor") { 
                        $reciever = Investor::find($recipient->profileable->id);
                    }
                    
                    if ($reciever) {
                        $reciever->wallet_balance += $data['amount'];
                        if ($reciever->save()) {
                            $status = "successful";
                            $message = "Transfer successful";
                        } else {
                            $sender->wallet_balance += $data['amount'];
                            $sender->save();
                            $status = "failed";
                            $message = "Transaction error.";
                        }
                    } else {
                        $sender->wallet_balance += $data['amount'];
                        $sender->save();
                        $status = "failed";
                        $message = "Transaction error. This transaction has been reversed";
                    }
                } else {
                    $status = "failed";
                    $message = "Transaction error.";
                }

            } else {
                $status = "failed";
                $message = "Insufficient fund";
            }
            
            $transaction = new Transaction();
            $transaction->reciever_address = $data['address'];
            $transaction->amount = $data['amount'];
            $transaction->message = $message;
            $transaction->status = $status;

            if (auth()->user()->transaction()->save($transaction)) {
                if ($status == "successful") {
                    $details = [
                        'name' => auth()->user()->profileable->firstname, 
                        'reciever' => $recipient->profileable->firstname . ' ' . $recipient->profileable->lastname, 
                        'amount' => $data['amount'], 
                        'wallet_balance' => $sender->wallet_balance, 
                        'new_wallet_balance' => $reciever->wallet_balance, 
                    ];
                    Mail::to(auth()->user()->email)->send(new TransferFundsMail($details));
                    Mail::to($recipient->email)->send(new RecieveFundsMail($details));

                    return [
                        "status" => true,
                        "message" => $message
                    ];
                } elseif ($status == "failed") {
                    return [
                        "status" => false,
                        "message" => $message
                    ];
                }
            }
        }


    }


    public function companyInfo($data)
    {
        $company = CompanyInfo::first();

        if ($company) {
            if ($company->update($data)) {
                return true;
            }
        } else {
            $company = new CompanyInfo();

            if ($company->create($data)) {
                return true;
            }
        }

        return false;

    }



    public function accountInfo($data)
    {
        $account = Account::create([
            "profile_id" => auth()->user()->id,
            "account_type" => "crypto"
        ]);

        if ($account->crypto()->create($data)) {
            return true;
        } else {
            return false;
        }
    }




    public function delete($data)
    {
        $account = Account::find($data);

        if ($account->delete()) {
            return true;
        } else {
            return false;
        }
    }

}