<?php

namespace App\Models;


use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Kyc extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        'id',
        'profile_id',
        'id_type',
        'id_number',
        'id_issue_date',
        'id_expiry_date',
        'front_view',
        'rear_view',
        'status',
        'reason'
    ];

    /**
     * Get the profile that owns the Kyc
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }
}
