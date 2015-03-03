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
	$.ajax({
        url: '/ajax/ajax_add_comment',
        cache: false,
        type: 'POST',
        dataType: 'json',
        
        success: function(response)
        {
        	console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        	// Handle errors here
        	console.log('ERRORS: ' + errorThrown);
        }
        
    });

}
