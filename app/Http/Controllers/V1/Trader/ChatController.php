<?php

namespace App\Http\Controllers\V1\Trader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Trader\ChatRepository;
use App\Events\Message;
use App\Models\Profile;
use App\Models\Chat;
use App\Models\Conversation;




class ChatController extends Controller
{
   
    public function index()
    {
        $conversations = Conversation::where('sender_id', auth()->user()->id)
                            ->orWhere('reciever_id', auth()->user()->id)
                            ->paginate(20);

        return view('v1.trader.conversations', compact('conversations'));
    }



    public function conversation(Conversation $conversation)
    {
        $chats = $conversation->chats;
        
        foreach ($chats as $item) {
            $chat = Chat::find($item->id);
            if ($chat->profile_id != auth()->user()->id) {
                $chat->read_status = true;
                $chat->save();
            }
        }
        return view('v1.trader.chat', compact('chats', 'conversation'));
    }




    public function store(Request $request)
    {
        $ChatRepository = new ChatRepository;
        $message = $ChatRepository->saveMessage($request->all());

        if($message) {
            event(new Message($message));
            return ['success' => true];
        } else {
            return back();
        }
    }

}
