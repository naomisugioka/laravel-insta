<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware'=>'auth'],function(){



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/create',[PostController::class,'create'])->name('post.create');

Route::post('/post/store',[PostController::class,'store'])->name('post.store');

Route::get('/post/{id}/show',[PostController::class,'show'])->name('post.show');

Route::get('/post/{id}/edit',[PostController::class,'edit'])->name('post.edit');

Route::patch('/post/{id}/update',[PostController::class,'update'])->name('post.update');

Route::delete('/post/{id}/destroy' ,[Postcontroller::class,'destroy'])->name('post.destroy');


Route::post('/comment/{post_id}/store',[CommentController::class,'store'])->name('comment.store');

Route::delete('/comment/{id}/destroy',[CommentController::class,'destroy'])->name('comment.destroy');

//PROFILE
Route::get('/profile/{id}/show',[ProfileController::class,'show'])->name('profile.show');

Route::get('/profile/edit',[ProfileController::class,'edit'])->name('profile.edit');

Route::patch('/profile/update',[ProfileController::class,'update'])->name('profile.update');

Route::post('/like/{post_id}/store',[LikeController::class,'store'])->name('like.store');


Route::delete('/like/{post_id}/destroy',[LikeController::class,'destroy'])->name('like.destroy');

Route::post('/follow/{user_id}/store',[FollowController::class,'store'])->name('follow.store');

Route::delete('/unfollow/{user_id}/destroy',[FollowController::class,'destroy'])->name('follow.destroy');

//profiles 2
Route::get('/profile/{id}/following',[ProfileController::class,'following'])->name('profile.following');


Route::get('/profile/{id}/follower',[ProfileController::class,'follower'])->name('profile.follower');

Route::patch('/profile/update-password',[ProfileController::class, 'updatePassword'])->name('profile.update-password');
//ADMIN
Route::group(['middleware'=>'admin'],function(){

Route::get('/admin/users',[UsersController::class,'index'])->name('admin.users');

Route::delete('/admin/users/{id}/deactivate',[UsersController::class,'deactivate'])->name('admin.users.deactivate');

Route::patch('/admin/users/{id}/activate',[UsersController::class,'activate'])->name('admin.users.activate');


Route::get('/admin/posts',[PostsController::class,'index'])->name('admin.posts');

Route::delete('/admin/posts/{id}/hide',[PostsController::class,'hide'])->name('admin.posts.hide');

Route::patch('/admin/posts/{id}/unhide',[PostsController::class,'unhide'])->name('admin.posts.unhide');

Route::get('/admin/categories',[CategoriesController::class,'index'])->name('admin.categories');

Route::delete('/admin/categories/{id}/destroy',[CategoriesController::class,'destroy'])->name('admin.categories.destroy');

Route::patch('/admin/categories/{id}/update',[CategoriesController::class,'update'])->name('admin.categories.update');

Route::post('/admin/categories/store',[CategoriesController::class,'store'])->name('admin.categories.store');


Route::get('/profile/suggested', [HomeController::class, 'show'])->name('home.suggest');
});
});

