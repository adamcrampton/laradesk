<?php

// General GET routes
Route::get('/', 'PagesController@index');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

// Passwords
Route::controller('password', 'RemindersController');

// Tickets Routing
Route::resource('tickets', 'TicketsController');

// Admin Routing
Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');

// Special Routes
Route::post('ajax/ajax_add_comment', 'AjaxController@ajax_add_comment');
