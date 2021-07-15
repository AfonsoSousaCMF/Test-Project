<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;

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

// Post Routes (With no Auth)
Route::get('/', 'PostsController@index')->name('posts');
Route::get('/posts/{id}', 'PostsController@show')->name('posts-show');
Route::get('/search', 'PostsController@search')->name('posts-search');

// Gallery Routes
Route::get('/image-gallery', 'ImageGalleryController@index')->name('gallery-index');
Route::post('/image-gallery', 'ImageGalleryController@upload')->name('gallery-upload');
Route::delete('/image-gallery/{id}', 'ImageGalleryController@destroy')->name('gallery-delete');

Auth::routes();

// Tag Routes
Route::get('/tags', 'TagsController@index')->name('tags')->middleware('auth.admin');
Route::delete('/tags/{id}', 'TagsController@destroy')->name('tags-delete')->middleware('auth.admin');
Route::post('/tags/restore/{id}', 'TagsController@restore')->name('tags-restore')->middleware('auth.admin');

// Posts Management Routes 
Route::get('/trash', 'HomeController@trash')->name('trash');
Route::get('/home', 'HomeController@index')->name('home');

// Post Routes (With Auth)
Route::get('/edit/{id}', 'PostsController@edit')->name('posts-edit');
Route::post('/restore/{id}', 'PostsController@restore')->name('posts-restore');
Route::post('/posts/store', 'PostsController@store')->name('posts-store');
Route::patch('/posts/update/{id}', 'PostsController@update')->name('posts-update');
Route::delete('/posts/delete/{id}', 'PostsController@destroy')->name('posts-delete');