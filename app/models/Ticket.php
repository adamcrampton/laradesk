<?php

Class Ticket extends Eloquent
{
	protected $table = 'master';
	protected $primaryKey = 'master_id';

	public function belongs()
	{
		// return User::where('users_id', $this->master_belongs_to_users_fk)->first()->users_username;

		return $this->belongsTo('User', 'master_belongs_to_users_fk', 'users_id');
	}

	public function assigned()
	{
		return $this->belongsTo('User', 'master_assigned_to_users_fk', 'users_id');
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