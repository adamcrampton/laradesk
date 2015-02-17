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

	{{ Form::open(['route' => 'sessions.store']) }}
	<div class="input-group">
		{{ Form::label('email', 'Email:') }}
		{{ Form:: email('email', null, array('class' => 'form-control')) }}
	</div>
	<div class="input-group">
		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password', array('class' => 'form-control')) }}
	</div>

	<div class="input-group"> 
		{{ Form::submit('Go', array('class' => 'btn btn-default')) }} 
	</div>

	<hr />
	<p>Forgot your password? {{ link_to('/password/remind', 'Click here')}}</p>

	{{ Form::close() }}

@stop