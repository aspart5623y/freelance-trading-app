<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'profile_id',
        'amount',
        'status',
        'account_id'
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
     * Get all of the account for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
    
}
