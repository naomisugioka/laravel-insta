<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    //post has many categoryPosts
    public function categoryPosts(){
        return $this->hasMany(CategoryPost::class);
    }

    //post belongs to 1 user
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    //post has many comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //post has many likes
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //return true if a post is liked by logged-in user
    public function isLiked(){
        return $this->likes()->where('user_id',Auth::user()->id)->exists();
        //$this->likes() = get all likes by $this post
        //where = among those likes,which one is by logged-in user?
        //exists =if where() finds records, return true
    }
}
