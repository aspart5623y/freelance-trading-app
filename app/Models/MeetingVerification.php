<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class MeetingVerification extends Model
{
    use HasFactory, UUID;


    protected $fillable = [
        "id",
        "admin_id",
        "trader_id",
        "meeting_date",
        "meeting_time",
        "meeting_link"
    ];


    /**
     * Get the Admin that owns the MeetingVerification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }


    /**
     * Get the Trader that owns the MeetingVerification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trader(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Trader::class);
    }


 
}
