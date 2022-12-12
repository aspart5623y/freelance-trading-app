<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Trader extends Model
{
    use HasFactory, UUID;
    

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'profile_img',
        'gender',
        'nationality',
        'percentage',
        'wallet_balance',
        'earnings',
        'expertise',
        'show_admin_rating',
        'admin_rating',
        'liquidity',
        'liquidity_amt'
    ];

    
    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }


    /**
     * Get the MeetingVerification associated with the MeetingVerification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function meetingVerification(): HasOne
    {
        return $this->hasOne(MeetingVerification::class);
    }


    /**
     * Get all of the Packages for the Trader
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    /**
     * Get all of the investments for the Trader
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investments(): HasMany
    {
        return $this->hasMany(\App\Models\Investment::class, 'trader_id', 'id');
    }

    /**
     * Get all of the investments for the Trader
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function success_investments(): HasMany
    {
        return $this->hasMany(\App\Models\Investment::class, 'trader_id', 'id')
                        ->where(function($query)
                            {
                                $query->where('status', 'completed')
                                        ->orWhere('status', 'accepted')
                                        ->orWhere('status', 'running');
                            });
    }




    /**
     * Get all of the ratings for the Trader
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(\App\Models\Rating::class, 'trader_id', 'id');
    }
    
}