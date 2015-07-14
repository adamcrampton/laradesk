@extends('layouts/default')

@section('content')

<div class="col-md-12">     
	<div class="row">
		<h1>Hi {{ Auth::user()->users_username }}</h1>
		<p class="lead">Select an option below:</p>
	</div>
</div>

<hr />

<div class="row">
	<div class="col-md-12">
		<a href="/tickets/create" class="btn btn-primary">Create a new ticket</a>
		@if (Auth::user()->isSupport())
		<a href="/tickets" class="btn btn-primary">View tickets assigned to me</a>
		@else
		<a href="/tickets" class="btn btn-primary">View my tickets</a>
		@endif
	</div>
</div>

<hr />

@if (Auth::user()->isSupport())

<h3>Support Staff Options:</h3>

<div class="row">
	<div class="col-md-12">
		<a href="/tickets?show_all=true" class="btn btn-primary">View All Tickets</a>
	</div>
</div>

<hr />

@endif

@if (Auth::user()->isAdmin())

<h3>Administrator Options:</h3>

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary">Manage Users</a>
		<a class="btn btn-primary">Manage Categories</a>
		<a class="btn btn-primary">Manage Status Types</a>
		<a class="btn btn-primary">Manage Priority Levels</a>
	</div>
</div>

@endif

@stop
