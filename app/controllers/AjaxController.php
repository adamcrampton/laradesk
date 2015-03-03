<?php

class AjaxController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('staff');
	}

	public function ajax_add_comment()
	{
		return json_encode(['value' => 'test']);
	}

}
