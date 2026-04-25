<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\PostReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'content' => 'nullable|string|max:1000',
      'mediaCreatePost.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:5020'
    ], [
      'mediaCreatePost.*.max' => 'File tidak boleh lebih dari 1020 KB'
    ], [
      'mediaCreatePost.*' => 'File'
    ]);

    $post = Post::create([
      'user_id' => Auth::id(),
      'content' => $validated['content'] ?? null,
      'privacy' => 'public'
    ]);

    if($request->hasFile('mediaCreatePost')){
      foreach($request->file('mediaCreatePost') as $index => $file){
        $path = $file->store('posts', 'public');

        PostMedia::create([
          'post_id' => $post->id,
          'file_path' => $path,
          'type' => Str::startsWith($file->getMimeType(), 'image') ? 'image' : 'video',
          'order' => $index
        ]);
      }
    }

    $html = view('components.partials.tengah.post-section', [
      'profile_img' => $post->user->avatar ? 'storage/' . $post->user->avatar : 'images/img-default.png',
      'first_name' => $post->user->first_name,
      'last_name' => $post->user->last_name,
      'posting_time' => $post->created_at->diffForHumans(),
      'title_post' => $post->content,
      'media' => $post->media,
      'total_interaction' => $post->reactions_count ?? 0,
      'comment' => $post->comments_count ?? 0,
      'share' => $post->shares_count ?? 0,
      'post' => $post
    ])->render();

    return response()->json([
      'status' => 'success',
      'html' => $html,
    ]);
  }

  public function like(Request $request)
  {
    $request->validate([
      'post_id' => 'required|exists:posts,id'
    ]);

    $postId = $request->post_id;
    $userId = Auth::id();

    $like = PostReaction::where('post_id', $postId)
      ->where('user_id', $userId)
      ->first();
    
    if($like){
      $like->delete();
      $status = 'unliked';
    }else{
      PostReaction::create([
        'post_id' => $postId,
        'user_id' => $userId,
        'type' => 'like'
      ]);

      $status = 'liked';
    }

    $total = PostReaction::where('post_id', $postId)->count();

    return response()->json([
      'status' => $status,
      'total' => $total
    ]);
  }
}
