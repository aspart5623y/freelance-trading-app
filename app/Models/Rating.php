<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Rating extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'trader_id',
        'investor_id',
        'rating'
    ];


    /**
     * Get the investor that owns the Investment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function investor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Investor::class, 'investor_id');
    }


    /**
     * Get the trader that owns the Investment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trader(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Trader::class, 'trader_id');
    }



}
