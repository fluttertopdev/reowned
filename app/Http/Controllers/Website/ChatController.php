<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Events\MessageSeen;
use App\Events\TypingEvent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\BlockedUser;
use App\Models\Item;
use App\Models\Tips;

class ChatController extends Controller
{

    public function startChat($itemId)
    {
        $item = Item::findOrFail($itemId);

        // prevent self chat
        if($item->user_id == Auth::id()){
            return redirect()->back()->with('error', __('lang.website.cannot_chat_on_own_item'));
        }

        // find or create conversation
        $conversation = \App\Models\Conversation::firstOrCreate(
            [
                'item_id' => $item->id,
                'buyer_id' => Auth::id(),
            ],
            [
                'seller_id' => $item->user_id
            ]
        );

        // redirect with conversation id
        return redirect()->route('chat.index', ['open' => $conversation->id]);
    }

    public function index()
    {
        $userId = Auth::id();

        $selling = Conversation::where('seller_id', $userId)
            ->with(['buyer','item','lastMessage'])
            ->orderByDesc('last_message_at')
            ->get();

        $buying = Conversation::where('buyer_id', $userId)
            ->with(['seller','item','lastMessage'])
            ->orderByDesc('last_message_at')
            ->get();

        $blockedUsers = BlockedUser::where('blocked_by', $userId)
            ->with('blockedUser')
            ->get();

        $tipsData = Tips::with('translation')
            ->where('status',1)
            ->get();

        return view('website.chat.index', compact('selling','buying','blockedUsers','tipsData'));
    }

    // CHAT LIST (SELLING + BUYING)
    public function chatList()
    {
        $userId = Auth::id();

        $chats = Conversation::with(['item','buyer','seller','lastMessage'])
            ->where(function($q) use ($userId){
                $q->where('seller_id',$userId)
                  ->orWhere('buyer_id',$userId);
            })
            ->get()
            ->map(function($c) use ($userId){

                $c->unread_count = Message::where('conversation_id',$c->id)
                    ->where('sender_id','!=',$userId)
                    ->where('is_seen',0)
                    ->count();

                return $c;
            })
            ->sortByDesc('last_message_at')
            ->values();

        return response()->json($chats);
    }

    // MESSAGES
    public function messages($id)
    {
        $conversation = Conversation::where('id',$id)
            ->where(function($q){
                $q->where('seller_id',Auth::id())
                  ->orWhere('buyer_id',Auth::id());
            })->firstOrFail();

        $messages = Message::where('conversation_id',$conversation->id)
            ->with('sender')
            ->orderBy('id','asc')
            ->get();

        // mark seen
        Message::where('conversation_id',$id)
            ->where('sender_id','!=',Auth::id())
            ->where('is_seen',0)
            ->update([
                'is_seen'=>1,
                'seen_at'=>now()
            ]);

        // BROADCAST SEEN EVENT
        event(new MessageSeen($id));

        $authId = Auth::id();

        // get other user id
        $otherUserId = $conversation->seller_id == $authId 
            ? $conversation->buyer_id 
            : $conversation->seller_id;

        // I blocked him?
        $blockedByMe = BlockedUser::where([
            'blocked_by' => $authId,
            'blocked_user_id' => $otherUserId
        ])->exists();

        // He blocked me?
        $blockedByOther = BlockedUser::where([
            'blocked_by' => $otherUserId,
            'blocked_user_id' => $authId
        ])->exists();

        return response()->json([
            'messages' => $messages,
            'blocked_by_me' => $blockedByMe,
            'blocked_by_other' => $blockedByOther
        ]);
    }

    // SEND MESSAGE
    public function send(Request $request)
    {
        $conversation = Conversation::findOrFail($request->conversation_id);

        // BLOCK CHECK
        if(BlockedUser::where([
            'blocked_by'=>$conversation->seller_id,
            'blocked_user_id'=>$conversation->buyer_id
        ])->orWhere([
            'blocked_by'=>$conversation->buyer_id,
            'blocked_user_id'=>$conversation->seller_id
        ])->exists()){
            return response()->json(['error'=>'blocked']);
        }

        $msg = Message::create([
            'conversation_id'=>$conversation->id,
            'sender_id'=>Auth::id(),
            'message'=>$request->message,
        ]);

        $conversation->update([
            'last_message_at'=>now()
        ]);

        // BROADCAST EVENT
        event(new MessageSent($msg));

        return response()->json($msg);
    }

    // BLOCK
    public function block(Request $request)
    {
        BlockedUser::firstOrCreate([
            'blocked_by'=>Auth::id(),
            'blocked_user_id'=>$request->user_id
        ]);

        return response()->json(['success'=>true]);
    }

    // UNBLOCK
    public function unblock(Request $request)
    {
        BlockedUser::where([
            'blocked_by'=>Auth::id(),
            'blocked_user_id'=>$request->user_id
        ])->delete();

        return response()->json(['success'=>true]);
    }

     
    // Typing...
    public function typing(Request $request)
    {
        event(new TypingEvent($request->conversation_id, Auth::id()));
        return response()->json(['ok'=>true]);
    }
    
    // Msg seen
    public function markSeen(Request $request)
    {
        $id = $request->conversation_id;

        Message::where('conversation_id',$id)
            ->where('sender_id','!=',Auth::id())
            ->where('is_seen',0)
            ->update([
                'is_seen'=>1,
                'seen_at'=>now()
            ]);

        // BROADCAST
        event(new MessageSeen($id));

        return response()->json(['ok'=>true]);
    }
}