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

    $notifications = $query->limit(20)->get();

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
