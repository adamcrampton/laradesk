@extends('layouts/default')

@section('content')

@if (Session::has('ticket_update_success'))
<?php $success = Session::get('ticket_update_success'); ?>
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>{{ $success }}</strong>
</div>
@endif

@if (Session::has('ticket_add_file_failed'))
<?php $success_but_file_failed = Session::get('ticket_add_success'); ?>
<div class="alert alert-warning alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>{{ $success_but_file_failed }}</strong>
</div>
@endif

@if (Session::has('ticket_update_failed'))
<?php $failed = Session::get('ticket_update_failed'); ?>
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>{{ $failed }}</strong>
</div>
@endif

<div class="col-md-12">     
	<div class="row">
		<p class="lead">This ticket:</p>
	</div>

	<div class="row">

	{{ Form::open(['method' => 'put', 'route' => 'tickets.update', 'files' => true]) }}

  	{{ Form::hidden('ticket_id', $ticket->master_id, ['id' => 'ticket_id']) }}
  	<div class="col-md-4">
		<div class="form-group">
	  		{{ Form::label('submitted_by', 'Submitted By: ') }}

			{{ Form::select('submitted_by', $attributes['staff_users_list'], $ticket->belongs->users_id, ['class' => 'form-control', $disabled_check]) }}

			{{ $errors->first('submitted_by', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('assigned_to', 'Assigned To: ') }}
			{{ Form::select('assigned_to', $attributes['support_users_list'], $ticket->master_assigned_to_users_fk ? $ticket->assigned->users_id : 0, ['class' => 'form-control', $disabled_check]) }}
			{{ $errors->first('assigned_to', '<span class="label label-danger">:message</span>') }}
		</div>
		
	</div>

	<div class="col-md-4">
		<div class="form-group">
	  		{{ Form::label('category', 'Category: ') }}
			{{ Form::select('category', $attributes['categories_list'], $ticket->category->categories_id, ['class' => 'form-control', $disabled_check]) }}
			{{ $errors->first('category', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('status', 'Status: ') }}
			{{ Form::select('status', $attributes['statuses_list'], $ticket->status->statuses_id, ['class' => 'form-control', $disabled_check]) }}
			{{ $errors->first('status', '<span class="label label-danger">:message</span>') }}
		</div>
	</div>

	<div class="col-md-4">
		<div id="related_files_container" class="form-group has-feedback">
			{{ Form::label('related_files', 'Upload related files (max 8mb): ', ['class' => 'control-label']) }}
			{{ Form::file('related_files[]', ['class' => 'form-control', 'multiple' => 'multiple']) }}
		</div>
		<div class="form-group">
	  		{{ Form::label('priority', 'Priority: ') }}
			{{ Form::select('priority', $attributes['priorities_list'], $ticket->priority->priorities_id, ['class' => 'form-control', $disabled_check]) }}
			{{ $errors->first('status', '<span class="label label-danger">:message</span>') }}
		</div>
	</div>
	<div class="col-md-12">
		<hr />
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('description', 'Description: ') }} {{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
			{{ Form::textarea('description', $ticket->master_description, ['class' => 'form-control']) }}
	  	</div>
	</div>
	<div class="col-md-6 comment_box">
	  	<div class="form-group"> 
			{{ Form::label('comments', 'Comments: ') }} {{ Form::button('Add Comment', ['id' => 'new_comment', 'class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#comment_modal']) }}
			<ul id="comment_list">
			@foreach($comments as $comment)
				<li class="list-group-item">{{ 'By <strong>' . $comment->users->users_username . '</strong> at ' . $comment->updated_at . '<br />' . $comment->comments_comment }}</li>
			@endforeach
			</ul>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group"> 
			{{ Form::submit('Update', ['class' => 'btn btn-success']) }} 
		</div>
	</div>
  	{{ Form::close() }}

	</div>

</div>

@stop
