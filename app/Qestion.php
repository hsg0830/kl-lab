<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qestion extends Model
{
    protected $fillable = [
        'content'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function articles()
    {
        return $this->belongsTo(Article::class);
    }
}
