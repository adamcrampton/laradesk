 //       _ _   _ _ _ _            _____           _       _       
 // | |  | | | (_) (_) |          / ____|         (_)     | |      
 // | |  | | |_ _| |_| |_ _   _  | (___   ___ _ __ _ _ __ | |_ ___ 
 // | |  | | __| | | | __| | | |  \___ \ / __| '__| | '_ \| __/ __|
 // | |__| | |_| | | | |_| |_| |  ____) | (__| |  | | |_) | |_\__ \
 //  \____/ \__|_|_|_|\__|\__, | |_____/ \___|_|  |_| .__/ \__|___/
 //                        __/ |                    | |            
 //                       |___/                     |_|  

// Initialise and config CKEditor
$(document).ready(function() 
{
	CKEDITOR.replace('content_editor', {
    });

    CKEDITOR.config.width = 540;
    CKEDITOR.config.height = 220;
    CKEDITOR.dtd.$removeEmpty.span = 0;
    CKEDITOR.dtd.$removeEmpty.i = 0;
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.contentsCss = ['/css/bootstrap.min.css', '/css/font-awesome.min.css', '/css/main.css'];
    CKEDITOR.config.autoParagraph = false;

    // Configure custom Styles dropdown	
    CKEDITOR.stylesSet.add( 'default', [
        { name: 'Button Name',   element: 'a', attributes: { 'class': 'class-name'} },
    ]);

});

// Ticket Comments
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
	$('#comment_add_success, #comment_add_warning, #comment_add_failed').removeClass('show').addClass('hide');

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
        	if (response.comment_status == 'success')
        	{
        		// Append new comment to list
        		$('#comment_list').append('<li>' + response.comment_text +'</li>');

        		// Show success message
        		$('#comment_add_success').addClass('show');

        	}

        	else if (response.comment_status == 'no content')
        	{
        		// Show warning if no comment submitted
        		$('#comment_add_warning').addClass('show');
        	}

        	
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        	// Show error
        	$('#comment_add_failed').addClass('show');
        }
        
    });

}
