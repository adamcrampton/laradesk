<?php

class TicketsController extends BaseController
{
	protected $content;

	public function __construct(Ticket $tickets)
	{
		$this->tickets = $tickets;

		$this->beforeFilter('staff');
	}

	public function index()
	{
		$all_tickets = $this->tickets->all();

		return View::make('tickets.index')->with('all_tickets', $all_tickets);
	}
		
	public function create($create_type = null)
	{
		
	}

	public function show($ticket_id = 0)
	{
		
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
			return Redirect::back()->with('deleted', 'Records were deleted');
		}

		return Redirect::back();
	}
	
}