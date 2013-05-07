/*  for wordpress 3.5 version */

jQuery(document).ready(function($){
	
    var custom_uploader;
  
    $('#upload_image_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Add Logo'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
			showANDsavLOGO(attachment.url)
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
 
}); //jQuery(document).ready(function($)


function showANDsavLOGO(logourl) {
	jQuery('.show-uploaded-login-logo').html('<img src="'+logourl+'" alt="Login Logo" />');
	var basewp = jQuery('.wp-url-add').val();
	jQuery.post(basewp+'/wp-admin/admin-ajax.php',{ action: 'show_and_save_login_logo', logo : logourl }, function(data) {
		
		if ( parseInt(data) == 0 ) {
			jQuery('.report-msg').html('<span style="background-color: #093; color: #FFFFFF; padding: 5px; border-radius: 5px;">Logo Saved Successfully.</span> &nbsp;<small>Now check your login screen and refresh the page to see your new logo.</small>');
		}
		else {
			jQuery('.report-msg').html('<span style="background-color: #F36; color: #FFFFFF; padding: 5px; border-radius: 5px;">Logo could not saved.</span>');
		}
		
		});//jQuery.post
	
}//function showANDsavLOGO()