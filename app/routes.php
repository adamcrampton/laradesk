<?php

// General GET routes
Route::get('/', 'PagesController@index');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::get('contact', 'PagesController@show_contact');
Route::get('/home', function() 
{
	return Redirect::to('/');
});

// Passwords
Route::controller('password', 'RemindersController');

// Admin Routing
// Route::resource('/users/roles', 'UserRolesController');
Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');
