<?php

use Illuminate\Support\Facades\Route;

Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware('auth')->group(function(){
    Route::get('/admin/posts', 'PostController@index')->name('post.index');
    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');

    Route::delete('/admin/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');
});

Route::middleware(['auth','can:view,post'])->group(function(){
    Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
});

Route::middleware(['auth','can:update,post'])->group(function(){
    Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.update');
});