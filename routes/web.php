<?php

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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('video', 'VideoController');

Route::get('/video/{video}/confirm', 'VideoController@confirm')->name('video.confirm');

Route::get('/videos/{video}/likes', 'VideoController@like')->name('video.like');

Route::get('/videos/{video}/unlikes', 'VideoController@unlike')->name('video.unlike');

Route::get('/metadata', 'MetadataController@index')->name('metadata.index');

Route::resource('user', 'UserController');

Route::get('/user/{user}/confirm', 'UserController@confirm')->name('user.confirm');