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

Route::get('/', 'PostController@index')->name('index');

Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/create', 'PostController@store')->name('post.store');
Route::get('/post/{slug}', 'PostController@show')->name('post.show');
Route::get('/post/{slug}/edit', 'PostController@edit')->name('post.edit');
Route::post('/post/{slug}/edit', 'PostController@update')->name('post.update');
