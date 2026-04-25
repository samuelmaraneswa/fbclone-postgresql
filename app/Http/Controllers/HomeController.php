<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $users = User::where('id', '!=', $user->id)
                  ->WhereDoesntHave('friends', function ($q) use ($user){
                    $q->where('friend_id', $user->id);
                  })
                  ->whereDoesntHave('friendOf', function ($q) use ($user){
                    $q->where('user_id', $user->id);
                  })
                  ->inRandomOrder()
                  ->take(10)
                  ->get();
    
    $posts = Post::with(['user', 'media'])->withCount(['reactions', 'comments', 'shares'])
        ->where(function ($q) use ($user){
          $q->where('user_id', $user->id)
            ->orWhere('user_id', function ($sub) use ($user){
              $sub->select('friend_id')
                  ->from('friends')
                  ->where('user_id', $user->id)
                  ->where('status', 'accepted');
            })
            ->orWhereIn('user_id', function ($sub) use ($user){
              $sub->select('user_id')
                  ->from('friends')
                  ->where('friend_id', $user->id)
                  ->where('status', 'accepted');
            });
        })
        ->latest()->get()
        ->map(function ($post) use ($user){
          $post->is_liked = $post->reactions()
            ->where('user_id', $user->id)
            ->exists();

            return $post;
        });
    
    return view('home', compact('user', 'users', 'posts'));
  }
}
