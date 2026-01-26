<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{


    // chat index view
public function index()
{
    $authId = Auth::id();

    // শুধুমাত্র Admin load
    $admin = User::where('role', 'admin')
                ->select('id', 'name', 'image', 'role')
                ->first();

    return view('userdashboard.chat.index', compact('admin'));
}




    // fetch messages
    public function fetch(Request $request)
    {
        if (Auth::user()->role !== 'user') {
            abort(403, 'Access Denied');
        }

        $request->validate([
            'receiver_id' => 'required|integer'
        ]);

        // unread messages seen update
        Chat::where('sender_id', $request->receiver_id)
            ->where('receiver_id', Auth::id())
            ->where('seen', false)
            ->update(['seen' => true]);

        $messages = Chat::where(function($q) use ($request){
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $request->receiver_id);
            })
            ->orWhere(function($q) use ($request){
                $q->where('sender_id', $request->receiver_id)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // send message (default receiver = admin id=1)
    public function send(Request $request)
    {
        if (Auth::user()->role !== 'user') {
            abort(403, 'Access Denied');
        }

        $request->validate([
            'message'     => 'required|string',
            'receiver_id' => 'nullable|integer'
        ]);

        $receiverId = $request->receiver_id ?: 1; // default admin

        $msg = Chat::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $receiverId,
            'message'     => $request->message,
            'seen'        => false,
        ]);

        return response()->json($msg);
    }

    // sidebar user list
    public function userList()
    {
        if (Auth::user()->role !== 'user') {
            abort(403, 'Access Denied');
        }

        $chats = Chat::where('sender_id', Auth::id())
                     ->orWhere('receiver_id', Auth::id())
                     ->orderBy('created_at', 'desc')
                     ->get();

        $users = $chats->map(function($chat){
            $user = $chat->sender_id == Auth::id() ? $chat->receiver : $chat->sender;
            if (!$user) return null;

            return [
                'id'       => $user->id,
                'name'     => $user->name,
                'photo'    => $user->photo ?? null,
                'admin' => $user->admin ?? 0,
                'last_msg' => $chat->message,
            ];
        })->filter()->unique('id')->values();

        return response()->json($users);
    }
}
