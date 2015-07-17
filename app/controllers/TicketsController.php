<?php

class TicketsController extends BaseController
{
	protected $tickets;

	public function __construct(Ticket $tickets)
	{
		$this->tickets = $tickets;

		$this->beforeFilter('staff');

		// Store attributes array to be used in the functions below.
		$this->attributes = [
			'staff_users_list' => User::lists('users_username', 'users_id'),
			'support_users_list' => User::lists('users_username', 'users_id'),
			'categories_list' => Category::lists('categories_name', 'categories_id'),
			'priorities_list' => Priority::lists('priorities_name', 'priorities_id'),
			'statuses_list' => Status::lists('statuses_name', 'statuses_id'),
		];

		// Add in an 'unassigned' item with an index of 0 to the support users list.
		// This is so we can display this in the view without having to have a database entry for 'unassigned';
		$this->attributes['support_users_list'][0] = 'unassigned';

		// Get current logged in user's auth level.
		$this->user_auth_level = Auth::user()->get_userlevel();

		// Check if current logged in user is Support or Admin user.
		$this->support_check = Auth::user()->isSupport();

	}

	public function index()
	{
		// Check if Show All parameter is set to true, and show all if they are at least support staff.
		if (isset($_GET['show_all']) && $_GET['show_all'] && $this->support_check)
		{
			$all_tickets = $this->tickets->all();
		}

		else
		{
			// Determine if user is support/admin, or regular staff user. 
			// Only show user's tickets if staff, otherwise show tickets assigned to this user (because they're support/admin).
			$all_tickets = ($this->support_check) ? $this->tickets->whereMaster_assigned_to_users_fk(Auth::id())->get() : $this->tickets->whereMaster_belongs_to_users_fk(Auth::id())->get();
		}

		return View::make('tickets.index', ['all_tickets' => $all_tickets]);
	}
		
	public function create($create_type = null)
	{
		return View::make('tickets.create', ['attributes' => $this->attributes, 'support_check' => $this->support_check]);
	}

	public function show($ticket_id = null)
	{
		if ($ticket_id !== null)
		{
			// Determine if user is support/admin, or regular staff user. Only show user's tickets if staff.
			if ($this->user_auth_level == 'Staff User')
			{
				// Find user id of staff member that owns this ticket.
				$ticket_owner = $this->tickets->whereMaster_id($ticket_id)->first()->master_belongs_to_users_fk;

				// If it's not the owner, boot them back to the ticket list with a message.
				if ($ticket_owner != Auth::id())
				{
					return Redirect::route('tickets.index')->with('not_authorised_to_view_ticket', 'Sorry, you are not authorised to view this ticket. Contact support for assistance.');
				}

			}

			// Create ticket object
			$ticket = $this->tickets->whereMaster_id($ticket_id)->first();

			// Create array for comments related to this ticket.
			$comments = Comment::whereComments_master_fk($ticket_id)->get();

			// This variable allows us to insert 'disabled' into input fields where user has less than support permissions.
			$disabled_check = $this->support_check ? null : 'disabled';
		
			return View::make('tickets.show', ['ticket' => $ticket, 'comments' => $comments, 'attributes' => $this->attributes, 'support_check' => $this->support_check, 'disabled_check' => $disabled_check]);
		}

		return Redirect::to('/')->with('no_ticket', 'Sorry, this ticket does not exist. Please contact support.');

	}

	public function store()
	{
		// Validate form fields first.
		if (! $this->tickets->isValid($input = Input::all())) 
		{
			return Redirect::back()->withInput()->withErrors($this->tickets->errors);
		}

		// Process post data.
		// Also check if user is support/admin - this will tell the add_ticket function to process POST values for submitted/assigned/status fields.
		$post_result = $this->tickets->add_ticket(Input::all(), $this->support_check);

		// Process file if it was uploaded and ticket was already saved.
		$file_result = true; // Set default to true in case there's no file attach. False will be returned if there's probs.

		if ($post_result['result'] && ! empty($_FILES['related_files']['name'][0]))
		{
			$file_upload = new File_upload;

			// Send file data and saved ticket ID.
			$file_result = $file_upload->upload_related_files(Input::file('related_files'), $post_result['id']);	
		}
		
		// If the post has saved and there wasn't a file upload problem, success.
		if ($post_result['result'] && $file_result)
		{
			return Redirect::route('tickets.index')->with('ticket_add_success', 'Ticket added successfully!');
		}

		else if ($post_result['result'] && ! $file_result)
		{
			return Redirect::route('tickets.index')->with('ticket_add_file_failed', 'Ticket added successfully, but something went wrong with the file upload. Please contact support.');	
		}

		return Redirect::route('tickets.index')->with('ticket_add_failed', 'Sorry, there was a problem creating your ticket. Please contact support.');

	}

	public function update()
	{
		// Create object for this ticket.
		$this_ticket = $this->tickets->whereMaster_id(Input::get('ticket_id'))->first();

		// Validate form fields first
		if (! $this->tickets->isValid($input = Input::all())) 
		{
			return Redirect::back()->withInput()->withErrors($this->tickets->errors);
		}

		// Process post data.
		// Also check if user is support/admin - this will tell the add_ticket function to process POST values for submitted/assigned/status fields.
		$post_result = $this->tickets->update_ticket(Input::all(), $this->support_check);

		// Process file if it was uploaded.
		$file_result = true; // Set default to true in case there's no file attach. False will be returned if there's probs.

		if (! empty($_FILES['related_files']['name'][0]))
		{
			$file_upload = new File_upload;

			$file_result = $file_upload->upload_related_files(Input::file('related_files'), $this_ticket->master_id);	
		}

		if ($post_result && $file_result)
		{
			return Redirect::back()->with('ticket_update_success', 'Ticket updated successfully!');
		}

		else if ($post_result['result'] && ! $file_result)
		{
			return Redirect::route('tickets.index')->with('ticket_add_file_failed', 'Ticket added successfully, but something went wrong with the file upload. Please contact support.');	
		}

		return Redirect::back()->with('ticket_update_failed', 'Sorry, there was a problem updating your ticket. Please contact support.');
	}

	public function destroy()
	{
		if (Input::has('delete'))
		{
			#!# Add in delete method

			return Redirect::back()->with('deleted', 'Records were deleted');
		}

		return Redirect::back();
	}
	
}