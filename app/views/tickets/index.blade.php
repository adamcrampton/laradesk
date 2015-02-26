@extends('layouts/default')

@section('content')

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
				<td>{{ $ticket->belongs_to_user() }}</td>
				<td>{{ $ticket->master_description }}</td>
				<td>{{ $ticket->category->categories_name }}</td>
				<td>{{ $ticket->priority->priorities_name }}</td>
				<td>{{ $ticket->assigned_to_user() }}</td>
				<td>{{ $ticket->status->statuses_name }}</td>
			</tr>
			@endforeach
		</table>
	</div>

</div>

<hr />

@stop
