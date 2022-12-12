<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = Conversation::orderBy('created_at', 'DESC')
                                        ->paginate(20);

        return view('v1.admin.conversations', compact('conversations'));
    }



    public function conversation(Conversation $conversation)
    {
        $chats = $conversation->chats;

        return view('v1.admin.chat', compact('chats', 'conversation'));
    }


}
