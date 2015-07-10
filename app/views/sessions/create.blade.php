@extends('layouts.default')

@section('content')

@if(Session::has('failed'))

<?php $failed = Session::get('failed'); ?>
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>{{ $failed }}</strong>
</div>
@endif

	<h1>Log In</h1>
	<p>Please log in using the form below.</p>
	<div class="row">
		{{ Form::open(['route' => 'sessions.store']) }}
		<div class="col-md-4">
			<div class="form-group">
				{{ Form::label('users_email', 'Email:') }}
				{{ Form::email('users_email', null, array('class' => 'form-control')) }}
				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>
			{{ Form::submit('Log in', array('class' => 'btn btn-primary')) }} 
		</div>
		{{ Form::close() }}
	</div>
	
@stop