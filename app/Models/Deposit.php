<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Deposit extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        'id',
        'profile_id',
        'amount',
        'account_id',
        'proof',
        'status'
    ];



    /**
     * Get the profile that owns the Kyc
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }



    /**
     * Get the account that owns the Kyc
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
    

}
