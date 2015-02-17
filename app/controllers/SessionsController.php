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
		$credentials = Input::only('email', 'password');

		if (Auth::attempt($credentials))
		{
			// Find out if this person is set to Staff level auth, and redirect to Wiki if so (note: Auth already done at this point)
			$auth_level = User::whereEmail(Input::get('email'))->first()->users_user_level_fk;

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