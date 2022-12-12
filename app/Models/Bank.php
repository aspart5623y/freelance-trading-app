<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'account_id',
        'bank_name',
        'account_name',
        'account_number',
        'code'
    ];


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
