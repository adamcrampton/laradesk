@extends('layouts/default')

@section('content')

<div class="col-md-12">     
	<div class="row">
		<p class="lead">This ticket:</p>
	</div>

	<div class="row">

	{{ Form::open(['method' => 'put', 'route' => 'tickets.update', 'files' => true]) }}

  	{{ Form::hidden('id', $ticket->master_id) }}
  	<div class="col-md-6">
		<div class="form-group">
	  		{{ Form::label('submitted_by', 'Submitted By: ') }}
			{{ Form::select('submitted_by', User::lists('users_username', 'users_id'), null, ['class' => 'form-control']) }}
			{{ $errors->first('submitted_by', '<span class="label label-danger">:message</span>') }}
		</div>
	</div>
	<div class="col-md-6	">
		<div id="content_doc_container" class="form-group has-feedback">
			{{ Form::label('content_doc', 'Upload and insert document (max 8mb): ', array('class' => 'control-label')) }}
			{{ Form::file('content_doc', array('class' => 'form-control')) }}
			<span id="content_doc_glyph" class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
			<span id="ajax-error-doc"></span>
		</div>
		<div id="content_image_container" class="form-group has-feedback">
			{{ Form::label('content_image', 'Upload and insert image: (max 8mb)', array('class' => 'control-label')) }}
			{{ Form::file('content_image', array('class' => 'form-control')) }}
			<span id="content_image_glyph" class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
			<span id="ajax-error-content"></span>
		</div>
	</div>
	<div class="col-md-12">
		<hr />
		<div class="form-group">
			{{ Form::label('description', 'Description: ') }} {{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
			{{ Form::textarea('description', $ticket->master_description, array('id' => 'content_editor', 'class' => 'form-control')) }}
	  	</div>
	  	<div class="form-group"> 
			{{ Form::submit('Update', array('class' => 'btn btn-success')) }} 
		</div>
	</div>
  	{{ Form::close() }}

	</div>

</div>

<hr />

@stop
