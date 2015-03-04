// General Scripts
$(document).ready(function() 
{
	$('#submit_comment').on('click', function() {
		add_comment();
	});

});

// AJAX Functions
function add_comment(event)
{
	// Hide modal, ensure status bar is hidden
	$('#comment_modal').modal('hide');
	$('#comment_add_success, #comment_add_failed').removeClass('show').addClass('hide');

	var form_data = new FormData();

	form_data.append('submitted_comment', $('#comment_add').val());
	form_data.append('ticket_id', $('#ticket_id').val());

	// Clear textarea
	$('#comment_add').val('');

	$.ajax({
        url: '/ajax/ajax_add_comment',
        cache: false,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        
        success: function(response)
        {
        	console.log(response);

        	// Append new comment to list
        	$('#comment_list').append('<li>' + response.comment_text +'</li>');

        	// Show success message
        	$('#comment_add_success').addClass('show');
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        	// Show error
        	$('#comment_add_failed').addClass('show');
        }
        
    });

}
