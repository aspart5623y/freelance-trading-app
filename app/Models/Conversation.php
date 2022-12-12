<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Traits\UUID;


class Conversation extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'sender_id',
        'reciever_id'
    ];


    /**
     * Get all of the chats for the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats(): HasMany
    {
        return $this->hasMany(\App\Models\Chat::class, 'conversation_id', 'id')->orderBy('created_at', 'ASC');
    }



    /**
     * Get the user associated with the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastchat(): HasOne
    {
        return $this->hasOne(\App\Models\Chat::class, 'conversation_id')->latest();
    }


    /**
     * Get the profile that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recieverProfile(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Profile::class, 'reciever_id', 'id');
    }

    /**
     * Get the profile that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function senderProfile(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Profile::class, 'sender_id', 'id');
    }
}
