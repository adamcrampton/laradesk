<?php

class PagesController extends BaseController
{
	public function __construct()
	{
		
	}

	public function index()
	{
		return View::make('pages.home');
	}
}
