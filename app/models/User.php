<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	// Mass assignment protection - fields passed not in this array will be ignored
	protected $fillable = ['username', 'password', 'email', 'role'];

	public $rules = 
	[
		'username' => 'required',
		'password' => 'required',
		'email' => 'required|unique:users,email'
	];

	public $errors;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'users_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	

	public function isValid($data)
	{
		$validation = Validator::make($data, $this->rules);

		if ($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();

		return false;
	}

	public function get_userlevel()
	{
		return Userlevel::whereUserlevels_id(Auth::user()->users_userlevels_fk)->first()->userlevels_name;
	}

	public function isAdmin()
	{
		$userlevel_name = $this->get_userlevel();

		if($userlevel_name == 'Admin User')
		{
			return true;
		}

		return false;	
	}

	public function isSupport()
	{
		$userlevel_name = $this->get_userlevel();

		if($userlevel_name == 'Admin User' || $userlevel_name == 'Support User')
		{
			return true;
		}

		return false;
	}
	
	public function isStaff()
	{
		$userlevel_name = $this->get_userlevel();

		if($userlevel_name == 'Admin User' || $userlevel_name == 'Support User' || $userlevel_name == 'Staff User')
		{
			return true;
		}

		return false;
	}

}
