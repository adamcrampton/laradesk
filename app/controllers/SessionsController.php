<?php

class SessionsController extends BaseController
{
	public function create()
	{
		if (Auth::check()) return Redirect::to('/');

		return View::make('sessions.create');
	}

	public function store()
	{
		$credentials = Input::only('users_email', 'password');

		if (Auth::attempt($credentials))
		{
			return View::make('pages.home');
		}

		return Redirect::back()->with('failed', 'Sorry, there was a problem with your username or password.');

	}

	public function destroy()
	{
		Auth::logout();

		return Redirect::route('home.index');
	}

}