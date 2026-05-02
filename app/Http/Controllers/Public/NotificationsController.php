<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
  public function index(Request $request)
  {
    $userId = Auth::id();
    $filter = $request->query('filter', 'all');

    $query = Notification::with('fromUser:id,first_name,last_name')->where('user_id', $userId)->latest();

    if($filter === 'unread'){
      $query->where('is_read', false);
    }

    $notifications = $query->limit(20)->get()->map(function ($notification) {
      return [
        'id' => $notification->id,
        'type' => $notification->type,
        'user_id' => $notification->user_id,
        'from_user_id' => $notification->from_user_id,
        'reference_id' => $notification->reference_id,
        'is_read' => $notification->is_read,
        'created_at' => $notification->created_at->diffForHumans(),
        'from_user' => $notification->fromUser,
      ];
    });

    return response()->json([
      'data' => $notifications
    ]);
  }

  public function markAsRead(Request $request)
  {
    $notif = Notification::where('id', $request->id)->where('user_id', Auth::id())->first();

    if($notif){
      $notif->is_read = true;
      $notif->save();
    }

    return response()->json(['status' => 'ok']);
  }
}
