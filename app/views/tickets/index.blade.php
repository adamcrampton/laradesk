@extends('layouts/default')

@section('content')

@if (Session::has('ticket_add_success'))
<?php $success = Session::get('ticket_add_success'); ?>
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>{{ $success }}</strong>
</div>
@endif

@if (Session::has('ticket_add_failed'))
<?php $failed = Session::get('ticket_add_failed'); ?>
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>{{ $failed }}</strong>
</div>
@endif

<div class="col-md-12">     
	<div class="row">
		<p class="lead">All tickets:</p>
	</div>

	<div class="row">
		<table class="table table-striped">
			<thead>
				<th>ID</th>
				<th>User</th>
				<th>Description</th>
				<th>Category</th>
				<th>Priority</th>
				<th>Assigned To</th>
				<th>Status</th>
			</thead>

			@foreach ($all_tickets as $ticket)
			<tr>
				<td>{{ $ticket->master_id }}</td>
				<td>{{ $ticket->belongs->users_username }}</td>
				<td>{{ link_to("/tickets/{$ticket->master_id}", $ticket->master_description) }}</td>
				<td>{{ $ticket->category->categories_name }}</td>
				<td>{{ $ticket->priority->priorities_name }}</td>
				<td>{{ $ticket->master_assigned_to_users_fk ? $ticket->assigned->users_username : 'unasssigned' }}</td>
				<td>{{ $ticket->status->statuses_name }}</td>
			</tr>
			@endforeach
		</table>
	</div>

</div>

<hr />

@stop
