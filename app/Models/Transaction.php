<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transaction extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        'id',
        'profile_id',
        'reciever_address',
        'amount',
        'status',
        'message'
    ];


    /**
     * Get the profile that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }

}
