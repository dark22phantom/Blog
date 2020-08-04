<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::put('/admin/users/{user}/update', 'UserController@update')->name('user.profile.update');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/users', 'UserController@index')->name('users.index');
    Route::get('/admin/users/create', 'UserController@create')->name('user.create');
    Route::post('/admin/users/store', 'UserController@store')->name('user.store');
    Route::delete('/admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');

    Route::put('/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('/users/{user}/detach', 'UserController@detach')->name('user.role.detach');
});

Route::middleware(['auth','can:view,user'])->group(function(){
    Route::get('/admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');
});