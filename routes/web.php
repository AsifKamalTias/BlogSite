<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/register', 'register')->name('register')->middleware('userNotLogged');
    Route::get('/sign-in', 'signIn')->name('sign-in')->middleware('userNotLogged');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/user/register', 'registerPost')->name('registerPost')->middleware('userNotLogged');
    Route::post('/user/sign-in', 'signInPost')->name('signInPost')->middleware('userNotLogged');
    Route::get('/user/profile', 'userProfile')->name('userProfile')->middleware('userLogged');
    Route::get('/user/sign-out', 'signOut')->name('sign-out')->middleware('userLogged');
});

Route::controller(BlogController::class)->group(function(){
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/create', 'createBlog')->name('createBlog')->middleware('userLogged');
    Route::post('/blog/create/post', 'createBlogPost')->name('createBlogPost')->middleware('userLogged');
    Route::get('/blog/{id}', 'blog')->name('blog');
    Route::get('/blog/edit/{id}', 'blogEdit')->name('blog-edit')->middleware('userLogged');
    Route::get('/blog/delete/{id}', 'blogDelete')->name('blog-delete')->middleware('userLogged');
});
