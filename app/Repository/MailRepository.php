<?php

namespace App\Repository;

use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMail;

class MailRepository {
    
    public function create($data)
    {
        if (Message::create($data)) {
            Mail::to($data['email'])->send(new AdminMail($data));
            return true;
        }
    }

}