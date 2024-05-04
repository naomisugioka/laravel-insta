<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    //follow ( from follows()) belongs to user
    public $timestamps = false;
    public function followed(){
        return $this->belongsTo(User::class, 'followed_id')->withTrashed();

    }

    //$this user is followed by many users/$this user has many followers
    public function followers(){
        return $this->hasMany(Follow::class,'followed_id');
    }

    //follow belongs to user (followers())
    public function follower(){
        return $this->belongsTo(User::class,'follower_id')->withTrashed();
    }
}
