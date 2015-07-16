<?php

Class Ticket extends Eloquent
{
	protected $table = 'master';
	protected $primaryKey = 'master_id';

	// DB Relationships.
	// ============================================

	public function belongs()
	{
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

	// Validation setup.
	// ============================================

	public $rules = 
	[
		'category' => 'required',
		'description' => 'required'
	];

	public $errors;

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

	// CRUD functions.
	// ============================================

	// Validate POST and add new ticket.
	public function add_ticket($ticket_data, $support_check)
	{
		$this->master_description = $ticket_data['description'];
		$this->master_belongs_to_users_fk = $support_check ? $ticket_data['submitted_by'] : Auth::id(); // Current logged in user if not specificed by support/admin.
		$this->master_assigned_to_users_fk = $support_check ? $ticket_data['assigned_to'] : 0; // The zero value matches other checks in views, where 0 will equate to 'unassigned'.
		$this->master_categories_fk = $ticket_data['category'];
		$this->master_priorities_fk = $ticket_data['priority'];
		$this->master_statuses_fk = $support_check ? $ticket_data['status'] : Status::whereStatuses_name('Open')->first()->statuses_id;

		// Save ticket.
		$result = $this->save();

		// Get ID of saved ticket - we'll need this for the file upload table in case files were uploaded.
		$saved_ticket_id = $this->master_id;

		if ($result)
		{
			return ['result' => true, 'id' => $saved_ticket_id];
		}

		return ['result' => false, 'id' => null];
	}

	public function update_ticket($ticket_data, $support_check)
	{
		// Create ticket object for record to be updated.
		$ticket = $this->whereMaster_id($ticket_data['ticket_id'])->first();

		$ticket->master_description = $ticket_data['description'];
		$ticket->master_belongs_to_users_fk = $support_check ? $ticket_data['submitted_by'] : Auth::id(); // Current logged in user if not specificed by support/admin.
		$ticket->master_assigned_to_users_fk = $support_check ? $ticket_data['assigned_to'] : 0; // The zero value matches other checks in views, where 0 will equate to 'unassigned'.
		$ticket->master_categories_fk = $ticket_data['category'];
		$ticket->master_priorities_fk = $ticket_data['priority'];
		$ticket->master_statuses_fk = $support_check ? $ticket_data['status'] : Status::whereStatuses_name('Open')->first()->statuses_id;

		// Save ticket.
		$result = $ticket->save();

		// Get ID of saved ticket - we'll need this for the file upload table in case files were uploaded.
		$saved_ticket_id = $ticket->master_id;

		if ($result)
		{
			return ['result' => true, 'id' => $saved_ticket_id];
		}

		return ['result' => false, 'id' => null];
	}

}