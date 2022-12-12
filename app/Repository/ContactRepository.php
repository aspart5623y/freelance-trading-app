<?php

namespace App\Repository;

use App\Models\Contact;


class ContactRepository {
    
    public function store($data)
    {
        return Contact::create($data) ? true : false; 
    }


}