<?php

class TicketsController extends BaseController
{
	protected $tickets;

	public function __construct(Ticket $tickets)
	{
		$this->tickets = $tickets;

		$this->beforeFilter('staff');
	}

	public function index()
	{
		$all_tickets = $this->tickets->all();

		return View::make('tickets.index', ['all_tickets' => $all_tickets]);
	}
		
	public function create($create_type = null)
	{
		
	}

	public function show($ticket_id = null)
	{
		if ($ticket_id !== null)
		{
			// Create ticket object
			$ticket = $this->tickets->whereMaster_id($ticket_id)->first();

			// Create array of vars for various ticket attributes
			$attributes = [
				'staff_users_list' => User::lists('users_username', 'users_id'),
				'support_users_list' => User::lists('users_username', 'users_id'),
				'categories_list' => Category::lists('categories_name', 'categories_id'),
				'priorities_list' => Priority::lists('priorities_name', 'priorities_id'),
				'statuses_list' => Status::lists('statuses_name', 'statuses_id'),
			];
			

			return View::make('tickets.show', ['ticket' => $ticket, 'attributes' => $attributes]);
		}

		return Redirect::to('/')->with('no_ticket', 'Sorry, this ticket does not exist. Please contact support.');

	}

	public function store()
	{

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