<div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="comment_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="comment_modal_label">Add comment to this ticket</h4>
      </div>
      <div class="modal-body">
        {{ Form::textarea('comment_add', null, ['id' => 'comment_add', 'class' => 'form-control']) }}
      </div>
      <div class="modal-footer">
        {{ Form::button('Cancel', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) }}
        {{ Form::button('Add Comment', ['class' => 'btn btn-primary', 'id' => 'submit_comment']) }}
      </div>
    </div>
  </div>
</div>