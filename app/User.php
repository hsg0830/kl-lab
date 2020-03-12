<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Article;
use App\Question;
use App\Answer;
use App\Resource;
use App\Offer;
use App\Ask;
use App\Reply;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'age', 'sex', 'password', 'is_admin', 'permission'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function asks()
    {
        return $this->hasMany(Ask::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
