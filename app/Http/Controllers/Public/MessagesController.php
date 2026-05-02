<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
  public function index($userId)
  {
    $authId = Auth::id();

    Message::where('sender_id', $userId)
      ->where('receiver_id', $authId)
      ->where('is_read', false)
      ->update(['is_read' => true]);
      
      $messages = Message::where(function ($q) use ($authId, $userId) {
        $q->where('sender_id', $authId)
        ->where('receiver_id', $userId);
      })
      ->orWhere(function ($q) use ($authId, $userId) {
        $q->where('sender_id', $userId)
        ->where('receiver_id', $authId);
      })
      ->orderBy('created_at', 'asc')
      ->get();
    
      return response()->json($messages);
  }

  public function store(Request $request)
  {
    $request->validate([
      'receiver_id' => 'required|exists:users,id',
      'message' => 'required|string',
    ]);

    $message = Message::create([
      'sender_id' => Auth::id(),
      'receiver_id' => $request->receiver_id,
      'message' => $request->message,
    ]);

    return response()->json($message);
  }

  public function conversations()
  {
    $authId = Auth::id();

    $messages = \App\Models\Message::where(function ($q) use ($authId) {
      $q->where('sender_id', $authId)
        ->orWhere('receiver_id', $authId);
    })
      ->with(['sender', 'receiver']) // wajib
      ->latest()
      ->get()
      ->groupBy(function ($msg) use ($authId) {
        return $msg->sender_id == $authId ? $msg->receiver_id : $msg->sender_id;
      })
      ->map(function ($group) {
        return $group->first(); // last message per user
      })
      ->values();

    return response()->json($messages);
  }

  public function unreadConversations()
  {
    $authId = Auth::id();

    $messages = Message::where('receiver_id', $authId)
      ->where('is_read', false)
      ->with(['sender', 'receiver'])
      ->latest()
      ->get()
      ->groupBy('sender_id')
      ->map(fn($group) => $group->first())
      ->values();

    return response()->json($messages);
  }

  public function unreadCount()
  {
    $count = \App\Models\Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->count();

    return response()->json(['count' => $count]);
  }
}
