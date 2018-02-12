<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PostComment extends Model
{
    //
    protected $fillable = ['user_id', 'post_id', 'comment'];

    //relationships
    public function post()
    {
    	return $this->belongsTo(App\Post::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
