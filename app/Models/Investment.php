<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Investment extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        'id',
        'investor_id',
        'package_id',
        'trader_id',
        'amount',
        'status'
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


    /**
     * Get the package that owns the Investment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Package::class, 'package_id');
    }



}
