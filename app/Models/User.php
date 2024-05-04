<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;


    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //user has many posts
    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    //$this user follows many users(has many follows)
    public function follows(){
        return $this->hasMany(Follow::class,'follower_id');
    }


    public function followers(){
        return $this->hasMany(Follow::class,'followed_id');
    }

     //return true if $this user is already followed by logged-in user
     public function isFollowed(){
        return $this->followers()->where('follower_id',Auth::user()->id)->exists();
        //$this->followers()= get list of followers of $this user
        //where()=which of the followers is the logged in user
        //exists() =if where() finds a record , return true
        
     }
}
