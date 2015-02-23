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
		<a class="btn btn-primary">Create a new ticket</a>
		<a class="btn btn-primary">View my tickets</a>
	</div>
</div>


<hr />

<h3>Support Staff Options:</h3>

<div class="row">
	<div class="col-md-12">
		<a href="/tickets" class="btn btn-primary">View Tickets</a>
	</div>
</div>

<hr />

<h3>Administrator Options:</h3>

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary">Manage Users</a>
		<a class="btn btn-primary">Manage Categories</a>
		<a class="btn btn-primary">Manage Status Types</a>
		<a class="btn btn-primary">Manage Priority Levels</a>
	</div>
</div>

@stop
