<?php

namespace App\Models;


use App\Traits\UUID;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Investor extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'phone',
        'pin',
        'wallet_balance',
        'earnings',
        'gender',
        'profile_img',
        'date_of_birth',
        'nationality',
        'address'
    ];


    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }


    /**
     * Get all of the investments for the Investor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investments(): HasMany
    {
        return $this->hasMany(\App\Models\Investment::class, 'investor_id', 'id');
    }
}
