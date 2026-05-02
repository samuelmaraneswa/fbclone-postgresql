<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
  public function index($tab = 'semua')
  {
    $user = Auth::user();

    $posts = Post::with(['user', 'media'])
      ->withCount(['reactions', 'comments', 'shares'])
      ->where('user_id', $user->id)
      ->latest()
      ->get()
      ->map(function ($post) use ($user) {
        $post->is_liked = $post->reactions()
          ->where('user_id', $user->id)
          ->exists();

        return $post;
      });

    $friends = User::whereIn('id', function ($query) use ($user) {
      $query->select('friend_id')
        ->from('friends')
        ->where('user_id', $user->id)
        ->where('status', 'accepted')

        ->union(

          DB::table('friends')
            ->select('user_id')
            ->where('friend_id', $user->id)
            ->where('status', 'accepted')
        );
    })->get();

    $photos = collect();

    if ($user->avatar) {
      $photos->push([
        'type' => 'avatar',
        'image' => asset('storage/' . $user->avatar),
        'post' => null,
      ]);
    }

    if ($user->cover) {
      $photos->push([
        'type' => 'cover',
        'image' => asset('storage/' . $user->cover),
        'post' => null,
      ]);
    }

    $postPhotos = $posts->flatMap(function ($post) { 
      return $post->media
        ->filter(function ($media) {
          return str_starts_with($media->type, 'image');
        })
        ->map(function ($media) use ($post) {
          return [
            'type' => 'post',
            'image' => asset('storage/' . $media->file_path),
            'post' => $post,
          ];
        });
    });

    $photos = $photos->merge($postPhotos)->values();

    if (request()->ajax()) {
      return view('public.profile.tabs.' . $tab, compact('user', 'tab', 'posts', 'friends', 'photos'));
    }

    return view('public.profile.index', [
      'tab' => $tab,
      'user' => $user,
      'posts' => $posts,
      'friends' => $friends,
      'photos' => $photos,
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

    $posts = Post::with(['user', 'media'])
      ->withCount(['reactions', 'comments', 'shares'])
      ->where('user_id', $user->id)
      ->latest()
      ->get()
      ->map(function ($post) use ($authId) {
        $post->is_liked = $post->reactions()
          ->where('user_id', $authId)
          ->exists();

        return $post;
      });

    $friends = User::whereIn('id', function ($query) use ($user) {
      $query->selectRaw("
        CASE 
            WHEN user_id = ? THEN friend_id
            ELSE user_id
        END
    ", [$user->id])
        ->from('friends')
        ->where(function ($q) use ($user) {
          $q->where('user_id', $user->id)
            ->orWhere('friend_id', $user->id);
        })
        ->where('status', 'accepted');
    })
      ->where('id', '!=', Auth::id())
      ->get();

    $photos = collect();

    if ($user->avatar) {
      $photos->push([
        'type' => 'avatar',
        'image' => asset('storage/' . $user->avatar),
        'post' => null,
      ]);
    }

    if ($user->cover) {
      $photos->push([
        'type' => 'cover',
        'image' => asset('storage/' . $user->cover),
        'post' => null,
      ]);
    }

    $postPhotos = $posts->flatMap(function ($post) {
      return $post->media
        ->filter(function ($media) {
          return str_starts_with($media->type, 'image');
        })
        ->map(function ($media) use ($post) {
          return [
            'type' => 'post',
            'image' => asset('storage/' . $media->file_path),
            'post' => $post,
          ];
        });
    });

    $photos = $photos->merge($postPhotos)->values();

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
      'posts' => $posts,
      'friends' => $friends,
      'isFriend' => $isFriend,
      'isFriendRequest' => $isFriendRequest,
      'isRequestReceived' => $isRequestReceived,
      'photos' => $photos,
    ]);
  }
}
