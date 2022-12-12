<?php

namespace App\Models;



use App\Traits\UUID;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Admin extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        "firstname",
        "lastname",
        "level",
        "pin"
    ];


    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }


    /**
     * Get the MeetingVerification associated with the MeetingVerification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meetingVerification(): HasMany
    {
        return $this->hasMany(MeetingVerification::class, 'admin_id', 'id');
    }
    
}