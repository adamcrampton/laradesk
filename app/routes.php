<?php

// General GET routes
Route::get('/', 'PagesController@index');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

// Passwords
Route::controller('password', 'RemindersController');

// Admin Routing
// Route::resource('/users/roles', 'UserRolesController');
Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');
