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

			return View::make('tickets.show', ['ticket' => $ticket]);
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