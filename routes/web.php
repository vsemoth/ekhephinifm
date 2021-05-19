<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('profiles', 'ProfileController');

Route::resource('admin/profiles', 'ProfilesController');

Route::resource('presenters', 'PresenterController');

Route::resource('images', 'ImageController');

Route::resource('users', 'UserController');

Route::resource('categories', 'CategoriesController');

Route::resource('posts', 'PostController');

Route::resource('shows', 'ShowController');

Route::get('audiofiles', 'AudioController@index')->name('audiofiles.index');

Route::resource('/audiofiles', 'AudioController',['except' => ['index']]);

Route::get('/play/{audio_slug}', ['uses' => 'PlayController@getSingle', 'as' => 'play.single'])->where('audio_slug', '[\w\d\-\_]+');

Route::get('/play', ['uses' => 'PlayController@getIndex', 'as' => 'play.index']);
