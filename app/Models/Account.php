<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Account extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'profile_id',
        'account_type'
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
     * Get all of the deposit for the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposit(): HasMany
    {
        return $this->hasMany(\App\Models\Deposit::class, 'account_id', 'id');
    }


    /**
     * Get all of the bank for the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bank(): HasOne
    {
        return $this->hasOne(\App\Models\Bank::class, 'account_id', 'id');
    }


    /**
     * Get all of the Crypto for the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function crypto(): HasOne
    {
        return $this->hasOne(\App\Models\Crypto::class, 'account_id', 'id');
    }

    /**
     * Get all of the paypal for the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paypal(): HasOne
    {
        return $this->hasOne(\App\Models\Paypal::class, 'account_id', 'id');
    }
}
