<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notification;
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

      Notification::where('type', 'post_like')
        ->where('from_user_id', $userId)
        ->where('reference_id', $postId)
        ->delete();

      $status = 'unliked';
    }else{
      $newLike = PostReaction::create([
        'post_id' => $postId,
        'user_id' => $userId,
        'type' => 'like'
      ]);

      $post = Post::find($postId);

      // notif hanya jika bukan like post sendiri
      if ($post && $post->user_id != $userId) {
        Notification::create([
          'user_id' => $post->user_id,
          'from_user_id' => $userId,
          'type' => 'post_like',
          'reference_id' => $postId,
          'is_read' => false,
        ]);
      }

      $status = 'liked';
    }

    $total = PostReaction::where('post_id', $postId)->count();

    return response()->json([
      'status' => $status,
      'total' => $total
    ]);
  }

  public function comment(Request $request)
  {
    $request->validate([
      'post_id' => 'required|exists:posts,id',
      'content' => 'required|string|max:1000',
    ]);

    $comment = Comment::create([
      'post_id' => $request->post_id,
      'user_id' => Auth::id(),
      'parent_id' => null,
      'content' => $request->content,
    ]);

    $post = Post::find($request->post_id);
    if ($post && $post->user_id != Auth::id()) {
      Notification::create([
        'user_id' => $post->user_id,
        'from_user_id' => Auth::id(),
        'type' => 'post_comment',
        'reference_id' => $request->post_id,
        'is_read' => false,
      ]);
    }

    $total = Comment::where('post_id', $request->post_id)->count();

    return response()->json([
      'status' => 'success',
      'message' => "Komentar berhasil di tambahkan",
      'comment' => $comment,
      'total' => $total
    ]);
  }

  public function getComments($postId)
  {
    $comments = Comment::with('user')
      ->where('post_id', $postId)
      ->whereNull('parent_id')
      ->latest()
      ->get();

    return response()->json([
      'status' => 'success',
      'comments' => $comments,
    ]);
  }

  public function show($id)
  {
    $user = Auth::user();

    $post = Post::with(['user', 'media'])
      ->withCount(['reactions', 'comments', 'shares'])
      ->findOrFail($id);

    $post->is_liked = $post->reactions()
      ->where('user_id', $user->id)
      ->exists();

    return view('public.posts.show', compact('post', 'user'));
  }
}
