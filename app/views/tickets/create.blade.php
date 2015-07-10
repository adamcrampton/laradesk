@extends('layouts/default')

@section('content')
		

	{{ Form::open(['method' => 'post', 'route' => 'tickets.store', 'files' => true]) }}

<div class="row">

	<div class="col-md-8">
		<p class="lead">Enter ticket details</p>
		<p>Please select a category, enter your ticket details, and upload any related files (e.g. screen captures) using the fields below.</p>
		<p>If you need to edit details of an existing ticket, <a href="/tickets/">click here</a> to find and select your ticket, and add a comment, which will be received by the support staff.<p>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
			  		{{ Form::label('category', 'Category: ') }}
					{{ Form::select('category', $attributes['categories_list'], null, ['class' => 'form-control']) }}
					{{ $errors->first('category', '<span class="label label-danger">:message</span>') }}
				</div>
			</div>
			<div class="col-md-6">
				<div id="related_files_container" class="form-group has-feedback">
					{{ Form::label('related_files', 'Upload related files (max 8mb): ', ['class' => 'control-label']) }}
					{{ Form::file('related_files', ['class' => 'form-control']) }}
					<span id="content_doc_glyph" class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
					<span id="ajax-error-upload"></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description: ') }} {{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
			{{ Form::textarea('description', null, ['class' => 'form-control']) }}
	  	</div>
	</div>		
	
	@if (Auth::user()->isSupport())

	<div class="col-md-4">
		<p class="lead">Admin Options</p>
		<hr />
		<div class="form-group">
	  		{{ Form::label('submitted_by', 'Submitted By: ') }}
			{{ Form::select('submitted_by', $attributes['staff_users_list'], null, ['class' => 'form-control']) }}
			{{ $errors->first('submitted_by', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('assigned_to', 'Assigned To: ') }}
			{{ Form::select('assigned_to', $attributes['support_users_list'], null, ['class' => 'form-control']) }}
			{{ $errors->first('assigned_to', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('status', 'Status: ') }}
			{{ Form::select('status', $attributes['statuses_list'], null, ['class' => 'form-control']) }}
			{{ $errors->first('status', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('priority', 'Priority: ') }}
			{{ Form::select('priority', $attributes['priorities_list'], null, ['class' => 'form-control']) }}
			{{ $errors->first('priority', '<span class="label label-danger">:message</span>') }}
		</div>		
	</div>

	@endif

	<div class="col-md-12">
		<div class="form-group"> 
			{{ Form::submit('Create ticket', ['class' => 'btn btn-success']) }} 
		</div>
	</div>
  	{{ Form::close() }}

</div>

@stop
