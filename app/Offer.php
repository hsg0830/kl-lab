<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
      'offer_content', 'user_id', 'user_of_handled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

