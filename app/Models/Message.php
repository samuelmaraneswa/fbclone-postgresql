<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
    'sender_id',
    'receiver_id',
    'message',
  ];

  // relasi pengirim
  public function sender()
  {
    return $this->belongsTo(User::class, 'sender_id');
  }

  // relasi penerima
  public function receiver()
  {
    return $this->belongsTo(User::class, 'receiver_id');
  }
}
