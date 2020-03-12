<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'article_id', 'content', 'user_id', 'user_of_handled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->belongsTo(Article::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
