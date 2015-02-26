<?php

Class Ticket extends Eloquent
{
	protected $table = 'master';
	protected $primaryKey = 'master_id';

	public function belongs_to_user()
	{
		return User::where('users_id', $this->master_belongs_to_users_fk)->first()->users_username;

		// return $this->belongsTo('User', 'users_id', 'master_belongs_to_users_fk');
	}

	public function assigned_to_user()
	{
		return User::where('users_id', $this->master_assigned_to_users_fk)->first()->users_username;
	}

	public function category()
	{
		return $this->belongsTo('Category', 'master_categories_fk', 'categories_id');
	}

	public function priority()
	{
		return $this->belongsTo('Priority', 'master_priorities_fk', 'priorities_id');
	}

	public function status()
	{
		return $this->belongsTo('Status', 'master_statuses_fk', 'statuses_id');
	}

}