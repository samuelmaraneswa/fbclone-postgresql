<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
  public function tambah(Request $request)
  {
    $request->validate([
      'friend_id' => 'required|exists:users,id'
    ]);

    $userId = Auth::id();
    $friendId = $request->friend_id;

    $exists = Friend::where(function ($q) use ($userId, $friendId){
      $q->where('user_id', $userId)
        ->where('friend_id', $friendId);
    })->orWhere(function ($q) use ($userId, $friendId){
      $q->where('user_id', $friendId)
        ->where('friend_id', $userId);
    })->exists();

    if($exists){
      return response()->json([
        'status' => 'exists'
      ]);
    }

    $friend = Friend::create([
      'user_id' => $userId,
      'friend_id' => $friendId,
      'status' => 'pending'
    ]);

    Notification::create([
      'user_id' => $friendId,
      'from_user_id' => $userId,
      'type' => 'friend_request',
      'reference_id' => $friend->id,
      'is_read' => false,
    ]);

    return response()->json([
      'status' => 'success'
    ]);
  }

  public function batal(Request $request)
  {
    $request->validate([
      'friend_id' => 'required|exists:users,id'
    ]);

    $userId = Auth::id();
    $friendId = $request->friend_id;

    Friend::where(function ($q) use ($userId, $friendId) {
    $q->where('user_id', $userId)
      ->where('friend_id', $friendId);
    })->orWhere(function ($q) use ($userId, $friendId) {
        $q->where('user_id', $friendId)
          ->where('friend_id', $userId);
    })->delete();

    Notification::where('type', 'friend_request')->where('from_user_id', $userId)->where('user_id', $friendId)->delete();

    return response()->json([
      'status' => 'deleted'
    ]);
  }

  public function terima(Request $request)
  {
    $authId = Auth::id();
    $friendId = $request->friend_id;

    $friend = Friend::where('user_id', $friendId)
        ->where('friend_id', $authId)
        ->where('status', 'pending')
        ->first();

    if(!$friend){
      return response()->json([
        'status' => 'not_found'
      ], 404);
    }

    $friend->status = 'accepted';
    $friend->save();

    Notification::create([
      'user_id' => $friendId,
      'from_user_id' => $authId,
      'type' => 'friend_accepted',
      'reference_id' => $friend->id,
      'is_read' => false
    ]);

    return response()->json([
      'status' => 'accepted'
    ]);
  }
}
