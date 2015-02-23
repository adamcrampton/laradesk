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
			@foreach ($all_tickets as $attribute)

			<tr>
				<td>{{ $attribute->master_id }}</td>
				<td>{{ $attribute->master_belongs_to_users_fk }}</td>
				<td>{{ $attribute->master_description }}</td>
				<td>{{ $attribute->master_categories_fk }}</td>
				<td>{{ $attribute->master_priorities_fk }}</td>
				<td>{{ $attribute->master_assigned_to_users_fk }}</td>
				<td>{{ $attribute->master_statuses_fk }}</td>
			</tr>

			@endforeach
		</table>
	</div>

</div>

<hr />

@stop
