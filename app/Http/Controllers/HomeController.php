<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        if($request->search){
           $home_posts = $this->post->where('description','LIKE','%'.$request->search.'%')
                                      ->latest()->get();  
            //SELECT * FROM posts WEHRE description LIKE '%serchword%'                         
        }else{
        $all_posts = $this->post->latest()->get();  
        //get all posts, with latest posts first

        //pass only posts by followed users AND logged-in user
        $home_posts = [];
        foreach($all_posts as $post){
            if($post->user->isFollowed() || $post->user->id == Auth::user()->id){
                $home_posts []= $post;
            }
        }
    }
        return view('user.home')->with('all_posts', $home_posts)
                                ->with('suggested_users', $this->getSuggestedUsers())
                                ->with('search',$request->search);
    }

    private function getSuggestedUsers(){ //return an array of suggested users
        $suggested_users = [];

        //list of all users
        $all_users = $this->user->all()->except(Auth::user()->id);
        // all()->except(ID)
        // get()->except(ID)

        $count = 0;
        foreach($all_users as $user){
            if(!$user->isFollowed() && $count<10){
                $suggested_users []= $user;
                $count++;
            }
        }

        return $suggested_users;
    }

  public function show(){
    $suggested_users = [];

    //list of all users
    $all_users = $this->user->all()->except(Auth::user()->id);
    // all()->except(ID)
    // get()->except(ID)

    $count = 0;
    foreach($all_users as $user){
        if(!$user->isFollowed()){
            $suggested_users []= $user;
            $count++;
        }
    }

    return view('user.profiles.suggest');
}


}