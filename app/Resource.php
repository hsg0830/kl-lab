<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
      'category', 'title', 'explanation', 'user_id', 'type_of_file', 'name_of_file', 'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
