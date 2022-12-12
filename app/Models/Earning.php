<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Earning extends Model
{
    use HasFactory, UUID;
    
    protected $fillable = [
        'id',
        'investment_id',
        'investor_id',
        'amount'
    ];
    


    /**
     * Get the investor that owns the Earning
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function investor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Investor::class, 'investor_id');
    }



    /**
     * Get the investment that owns the Earning
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function investment(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Investment::class, 'investment_id');
    }

}
