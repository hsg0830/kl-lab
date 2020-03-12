<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Ask;

class Reply extends Model
{
    protected $fillable = [
      'ask_id', 'reply_content', 'user_id',
    ];

    public function ask()
    {
        return $this->belongsTo(Ask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
