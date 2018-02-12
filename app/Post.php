<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\PostComment;
use App\Like;


class Post extends Model
{
    //
    protected $fillable = [ 'user_id', 'post', 'pic_name'];

    //relationships
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
    	return $this->hasMany(PostComment::class);
    }

    public function likes()
    {
        return $this->belongsTo(Like::class);
    }
}
