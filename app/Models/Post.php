<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['user_id', 'content', 'privacy'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function media()
  {
    return $this->hasMany(PostMedia::class)->orderBy('order');
  }

  public function reactions()
  {
    return $this->hasMany(PostReaction::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function shares()
  {
    return $this->hasMany(Share::class);
  }
}
