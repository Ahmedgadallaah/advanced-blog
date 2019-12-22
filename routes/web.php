<?php
use App\Http\Controllers\BackEnd\UsersController;

//use Symfony\Component\Routing\Annotation\Route;

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
//|---------------------------Admin Routes--------------
Route::namespace('BackEnd')->prefix('admin')->middleware('admin')->group(function(){
    Route::get('/dashboard','HomeController@index')->name('admin.home');
     Route::resource('users','UsersController')->except(['show']);
     Route::resource('categories','CategoriesController')->except(['show']);
     Route::resource('skills','SkillsController')->except(['show']);
     Route::resource('tags','TagsController')->except(['show']);
     Route::resource('pages','PagesController')->except(['show']);
     Route::resource('videos','VideosController')->except(['show']);
     Route::resource('messages','MessagesController')->only(['index','edit','destroy']);
     Route::post('messages/replay/{id}','MessagesController@replay')->name('message.replay');
     Route::post('comments','VideosController@commentstore')->name('comment.store');
     Route::get('comments/{id}','VideosController@commentDelete')->name('comment.delete');
     Route::post('comments/{id}','VideosController@commentUpdate')->name('comment.update');

    });

Auth::routes();
//|-------------------------Normal User Routes-----------------------------
Route::middleware('auth')->group(function(){
    Route::post('comments/{id}', 'HomeController@commentUpdate')->name('front.commentUpdate');
    Route::post('comments/{id}/create', 'HomeController@commentStore')->name('front.commentStore');
    Route::post('profile', 'HomeController@profileUpdate')->name('profile.update');    

});
//|------------------------- Visitor Routes -------------------------------

Route::get('/','HomeController@welcome' )->name('frontend.landing');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('category/{id}', 'HomeController@category')->name('front.category');
Route::get('skill/{id}', 'HomeController@skill')->name('front.skill');
Route::get('tag/{id}', 'HomeController@tag')->name('front.tags');
Route::get('video/{id}', 'HomeController@video')->name('frontend.video');
Route::get('contact-us', 'HomeController@messageStore')->name('contact.store');
Route::get('page/{id}/{slug?}', 'HomeController@page')->name('front.page');
Route::get('profile/{id}/{slug?}', 'HomeController@profile')->name('front.profile');