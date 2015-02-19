<?php

class PagesController extends BaseController
{
	public function __construct()
	{
		// Session::flush();
		$this->beforeFilter('staff');
	}

	public function index()
	{
		return View::make('pages.home');
	}
}
