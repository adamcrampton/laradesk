@extends('layouts/default')

@section('content')

<div class="col-md-12">     
	<div class="row">
		<p class="lead">This ticket:</p>
	</div>

	<div class="row">

	{{ Form::open(['method' => 'put', 'route' => 'tickets.update', 'files' => true]) }}

  	{{ Form::hidden('id', $ticket->master_id) }}
  	<div class="col-md-4">
		<div class="form-group">
	  		{{ Form::label('submitted_by', 'Submitted By: ') }}
			{{ Form::select('submitted_by', $attributes['staff_users_list'], $ticket->belongs->users_id, ['class' => 'form-control']) }}
			{{ $errors->first('submitted_by', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('assigned_to', 'Assigned To: ') }}
			{{ Form::select('assigned_to', $attributes['support_users_list'], $ticket->assigned->users_id, ['class' => 'form-control']) }}
			{{ $errors->first('assigned_to', '<span class="label label-danger">:message</span>') }}
		</div>
		
	</div>

	<div class="col-md-4">
		<div class="form-group">
	  		{{ Form::label('category', 'Category: ') }}
			{{ Form::select('category', $attributes['categories_list'], $ticket->category->categories_id, ['class' => 'form-control']) }}
			{{ $errors->first('category', '<span class="label label-danger">:message</span>') }}
		</div>
		<div class="form-group">
	  		{{ Form::label('status', 'Status: ') }}
			{{ Form::select('status', $attributes['statuses_list'], $ticket->status->statuses_id, ['class' => 'form-control']) }}
			{{ $errors->first('status', '<span class="label label-danger">:message</span>') }}
		</div>
	</div>

	<div class="col-md-4">
		<div id="content_doc_container" class="form-group has-feedback">
			{{ Form::label('content_doc', 'Upload and insert document (max 8mb): ', ['class' => 'control-label']) }}
			{{ Form::file('content_doc', ['class' => 'form-control']) }}
			<span id="content_doc_glyph" class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
			<span id="ajax-error-doc"></span>
		</div>
		<div id="content_image_container" class="form-group has-feedback">
			{{ Form::label('content_image', 'Upload and insert image: (max 8mb)', ['class' => 'control-label']) }}
			{{ Form::file('content_image', ['class' => 'form-control']) }}
			<span id="content_image_glyph" class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
			<span id="ajax-error-content"></span>
		</div>
	</div>
	<div class="col-md-12">
		<hr />
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('description', 'Description: ') }} {{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
			{{ Form::textarea('description', $ticket->master_description, ['id' => 'content_editor', 'class' => 'form-control']) }}
	  	</div>
	</div>
	<div class="col-md-6">
	  	<div class="form-group"> 
			{{ Form::label('comments', 'Comments: ') }} {{ Form::button('Add Comment', ['class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#comment_modal']) }}
			<ul>
			@foreach($comments as $comment)
				<li>{{ $comment->updated_at . ': ' . $comment->comments_comment }}</li>
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
