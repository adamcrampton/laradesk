<?php

Class Comment extends Eloquent
{
	protected $table = 'comments';
	protected $primaryKey = 'comments_id';

	// DB Relationships
	public function master()
	{
		return $this->belongsTo('Master', 'comments_master_fk', 'master_id');
	}

	public function users()
	{
		return $this->belongsTo('User', 'comments_users_fk', 'users_id');
	}

}