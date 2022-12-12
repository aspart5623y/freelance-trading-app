<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        'id',
        'title',
        'color'
    ];



    /**
     * Get all of the packages for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(\App\Models\Package::class);
    }


}
