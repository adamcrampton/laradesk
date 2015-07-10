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

	}

	public function index()
	{
		// Determine if user is support/admin, or regular staff user. Only show user's tickets if staff.
		$all_tickets = ($this->user_auth_level != 'Staff User') ? $this->tickets->all() : $this->tickets->whereMaster_belongs_to_users_fk(Auth::id())->get();

		return View::make('tickets.index', ['all_tickets' => $all_tickets]);
	}
		
	public function create($create_type = null)
	{
		return View::make('tickets.create', ['attributes' => $this->attributes]);
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

			// Create array for comments related to this ticket
			$comments = Comment::whereComments_master_fk($ticket_id)->get();
		
			return View::make('tickets.show', ['ticket' => $ticket, 'comments' => $comments, 'attributes' => $this->attributes]);
		}

		return Redirect::to('/')->with('no_ticket', 'Sorry, this ticket does not exist. Please contact support.');

	}

	public function store()
	{
		// Validate form fields first
		if (! $this->tickets->isValid($input = Input::all())) 
		{
			return Redirect::back()->withInput()->withErrors($this->tickets->errors);
		}

		// Process file if it was uploaded.
		$file_result = true; // Set default to true in case there's no file attach. False will be returned if there's probs

		if (!empty($_FILES['related_image']['name']))
		{
			$file_result = $this->tickets->upload_related_image(Input::file('related_image'));	
		}
		
		// Now process post data.
		$post_result = $this->tickets->add_ticket(Input::all());

		if ($post_result && $file_result)
		{
			return Redirect::route('tickets.index')->with('ticket_add_success', 'Ticket added successfully!');
		}

		return Redirect::route('tickets.index')->with('ticket_add_failed', 'Sorry, there was a problem creating your ticket. Please contact support.');

	}

	public function update()
	{

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