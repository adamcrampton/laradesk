<?php

Class Comment extends Eloquent
{
	protected $table = 'comments';
	protected $primaryKey = 'comments_id';

	public function master()
	{
		return $this->belongsTo('Master', 'comments_master_fk', 'master_id');
	}

}