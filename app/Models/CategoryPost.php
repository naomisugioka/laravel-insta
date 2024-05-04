<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_post';//if table name is not plural form
    public $timestamps = false;//do not save timestamps for this table
    protected $fillable =['category_id','post_id'];//for the use of create()/createMany()

    //1 categoryPost belongs to 1 category
    public function category(){
        return $this->belongsTo(Category::class);
    }
    //1categoryPost belongs to 1 post (unused)
    //public function post(){
        //return $this->belongsTo(Post::class);
    }

