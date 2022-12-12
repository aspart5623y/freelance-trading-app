<?php


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\UUID;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Profile extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, UUID;
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'profileable_id',
        'profileable_type',
        'password',
        'remember_token',
        'email_verified_at' => 'datetime',
    ];

  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

  

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profileable()
    {
        return $this->morphTo();
    }

    /**
     * Get the Kyc associated with the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kyc(): HasOne
    {
        return $this->hasOne(\App\Models\Kyc::class, 'profile_id', 'id');
    }

    /**
     * Get all of the account for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account(): HasMany
    {
        return $this->hasMany(\App\Models\Account::class, 'profile_id', 'id');
    }


    /**
     * Get all of the transaction for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(\App\Models\Transaction::class, 'profile_id', 'id');
    }


    /**
     * Get all of the deposit for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposit(): HasMany
    {
        return $this->hasMany(\App\Models\Deposit::class, 'profile_id', 'id');
    }



    /**
     * Get all of the withdrawal for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function withdrawal(): HasMany
    {
        return $this->hasMany(\App\Models\Withdrawal::class, 'profile_id', 'id');
    }


    /**
     * Get all of the conversations for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(\App\Models\Conversation::class, 'sender_id', 'id');
    }


    /**
     * Get all of the chats for the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats(): HasMany
    {
        return $this->hasMany(\App\Models\Chat::class, 'profile_id', 'id');
    }


}
