<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        'id',
        'account_id',
        'account_email',
        'account_name'
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
