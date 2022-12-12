<?php

namespace App\Repository\Trader;

use App\Models\Chat;
use App\Models\Conversation;

class ChatRepository {

    public function saveMessage($data)
    {
        $conversation = Conversation::find($data['conversation_id']);
        $chat = new Chat();
        $chat->message_type = $data['message_type'];
        $chat->extension = $data['extension'];
        $chat->message_text = $data['message_text'];
        $chat->profile_id = auth()->user()->id;

        $conversation->chats()->save($chat);
        return $chat;
    }




}