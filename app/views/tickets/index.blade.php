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
                <td>{{ isset($ticket->belongs->users_username)? $ticket->belongs->users_username : 'no user' }}</td>
                <td>{{ link_to("/tickets/{$ticket->master_id}", $ticket->master_description) }}</td>
                <td>{{ isset($ticket->category->categories_name) ? $ticket->category->categories_name : 'no category' }}</td>
                <td>{{ isset($ticket->priority->priorities_name) ? $ticket->priority->priorities_name : 'no priority' }}</td>
                <td>{{ isset($ticket->assigned->users_username)?$ticket->assigned->users_username : 'unassigned' }}</td>
                <td>{{ isset($ticket->status->statuses_name) ? $ticket->status->statuses_name : 'no status' }}</td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

<hr />

@stop
