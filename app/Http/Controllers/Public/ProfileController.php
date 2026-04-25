<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function index($tab = 'semua')
  {
    $user = Auth::user();

    if (request()->ajax()) {
      return view('public.profile.tabs.' . $tab, compact('user', 'tab'));
    }

    return view('public.profile.index', [
      'tab' => $tab,
      'user' => $user
    ]);
  }

  public function uploadFotoProfile(Request $request)
  {
    $request->validate([
      'avatar' => 'required|image|max:10048'
    ]);

    $path = $request->file('avatar')->store('avatars', 'public');

    User::where('id', Auth::id())->update([
      'avatar' => $path
    ]);

    return back();
  }

  public function uploadCover(Request $request)
  {
    $request->validate([
      'cover' => 'required|image|max:10048'
    ]);

    $path = $request->file('cover')->store('covers', 'public');

    User::where('id', Auth::id())->update([
      'cover' => $path
    ]);

    return back();
  }

  public function edit()
  {
    $user = Auth::user();
    return view('public.profile.edit', compact('user'));
  }

  public function update(Request $request)
  {
    $validated = $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'date_of_birth' => 'required',
      'gender' => 'required',
      'email' => 'required|email|unique:users,email,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->update($validated);

    return response()->json([
      'message' => 'Success',
      'redirect' => route('profile.index')
    ]);
  }

  public function show($id, $tab = 'semua')
  {
    $user = User::findOrFail($id);
    $authId = Auth::id();

    $isFriend = Friend::where(function ($q) use ($authId, $id){
      $q->where(function ($q2) use ($authId, $id){
        $q2->where('user_id', $authId)
           ->where('friend_id', $id);
      })->orWhere(function ($q2) use ($authId, $id){
        $q2->where('user_id', $id)
           ->where('friend_id', $authId);
      });
    })->where('status', 'accepted')->exists();

    $isFriendRequest = Friend::where('user_id', Auth::id())
        ->where('friend_id', $user->id) 
        ->where('status', 'pending') 
        ->exists();

    $isRequestReceived = Friend::where('user_id', $id)
      ->where('friend_id', $authId)
      ->where('status', 'pending')
      ->exists();

    return view('public.profile.index', [
      'user' => $user,
      'tab' => $tab,
      'isFriend' => $isFriend,
      'isFriendRequest' => $isFriendRequest,
      'isRequestReceived' => $isRequestReceived,
    ]);
  }
}
