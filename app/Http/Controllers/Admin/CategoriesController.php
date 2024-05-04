<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller

{   
    public function __construct(Category $category, Post $post){
        $this->category= $category;
        $this->post=$post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('name')->get();

        //get the no.of Uncategorized posts
        $all_posts = $this->post->all();
        $uncategorized_count = 0;
        foreach($all_posts as $post){
            if($post->categoryPosts->count() == 0){
                $uncategorized_count++;
            }
        }


        return view('admin.categories.index')->with('all_categories', $all_categories)
                                              ->with('uncategorized_count',$uncategorized_count);
    }

    public function store(Request $request){
        $request->validate([
            'category_name'=> 'required|max:50|unique:categories,name'
        ]);

        $this->category->name = $request->category_name;
        $this->category->save();

        return redirect()->back();
    }
    
    public function destroy($id){
        $this->category->destroy($id);//destroy -needs primary key (ID)

        //2nd way
        // $category_a=$this->category->findOrFail($id);
        // $category_a->delete(); //delete-does not need primary ID


        return redirect()->back();
    }
    
    public function update(Request $request,$id){
        $request->validate([
            'category_name'=> 'required|max:50|unique:categories,name'.$id
        ]);

        $categ_a = $this->category->findOrFail($id);

        $categ_a->name = $request->category_name;
        $categ_a->save();

        return redirect()->back();
    }

}

    
    
        
    

