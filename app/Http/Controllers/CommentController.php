<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

use App\Models\Comment;
class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment){
        $this->comment =$comment;//$this->comment =new Comment;
    }
    
    public function store(Request $request,$post_id){
        $request->validate([
            'comment_body'.$post_id => 'required|max:200'
        ],
    [
        'comment_body'.$post_id.'.required' => 'You cannot post an empty comment.' ,
          //comment_ body2.required
          'comment_body'.$post_id.'.max' => '200 characters maximum only.'
    ]);
        $this->comment->body= $request->input('comment_body'.$post_id);
        $this->comment->post_id= $post_id;
        $this->comment->user_id= Auth::user()->id;
        $this->comment->save();


        //go back to previous page(form)
        return redirect()->back();
    }    
    
    public function destroy($id){
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
