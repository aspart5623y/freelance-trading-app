<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        "id",
        "trader_id",
        "title",
        "roi",
        "service_id",
        "duration",
        "minimum_amount",
        "maximum_amount",
        "description"
    ];


    /**
     * Get the trader that owns the package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trader(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Trader::class);
    }


     /**
     * Get the Service that owns the package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Service::class);
    }


    /**
     * Get all of the investments for the package
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investments(): HasMany
    {
        return $this->hasMany(\App\Models\Investment::class, 'package_id', 'id');
    }

}
