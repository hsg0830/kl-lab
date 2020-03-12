<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Reply;

class Ask extends Model
{
    protected $fillable = [
      'category', 'title', 'ask_content', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
