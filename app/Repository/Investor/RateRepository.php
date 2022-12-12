<?php

namespace App\Repository\Investor;
use App\Models\Rating;


class RateRepository {

    public function store($data)
    {   $rating = Rating::where('investor_id', $data['investor_id'])
                            ->where('trader_id', $data['trader_id'])
                            ->first();

        if ($rating) {
            return $rating->update($data) ? true : false;
        }
        
        return Rating::create($data) ? true : false;
    }   


}