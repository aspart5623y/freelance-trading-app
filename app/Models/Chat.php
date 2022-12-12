<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Chat extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'conversation_id',
        'profile_id',
        'message_type',
        'extension',
        'message_text',
        'read_status',
    ];


    /**
     * Get the conversation that owns the Kyc
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Conversation::class);
    }


    /**
     * Get the profile that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }

}
