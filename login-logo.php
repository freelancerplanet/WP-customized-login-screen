<?php
add_action('admin_menu','add_image_upload_menu');
function add_image_upload_menu() {
	add_options_page('Upload logo Image','Change Login Screen','manage_options','upload-login-page-logo','upload_logo_menu_page');
}

function upload_logo_menu_page() {
	?>
    <div class="logo-container" style="width:60%; margin: 15% auto; "> 
           <div class="report-msg"></div>        
           <div class="show-uploaded-login-logo" style="margin-top: 5%;">       
           <?php
           $showlogo = mnh_get_logo_image();
           if ( isset($showlogo) && strlen($showlogo) > 0 ):
                echo '<img src="'.get_bloginfo('wpurl').'/wp-admin/images/'.$showlogo.'" alt="Login Logo" /><br /><small>Current logo is displaying, to change logo just simply use <b>Upload Login Screen Logo button</b>.</small>';
           endif;
            ?>
            </div><!-- .show-uploaded-login-logo -->
           <br  />
           
            <label for="upload_image">
                <input id="upload_image_button" class="button button-primary button-large" type="button" value="Upload Login Screen Logo" />
                <small>For best result use 250 X 250 pixel size Logo.Use .JPG .PNG .GIF image types.</small>
            </label>
            <input type="hidden" class="wp-url-add" value="<?php echo get_bloginfo('wpurl'); ?>"  />
        </div> <!-- .logo-container -->
                
        
<?php }//upload_logo_menu_page() ?>
<?php
//WORDPRESS VERSION 3.5
add_action('admin_enqueue_scripts', 'my_admin_scripts');
 
function my_admin_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'upload-login-page-logo') {
        wp_enqueue_media();
        wp_register_script('my-admin-js', plugins_url('/js/js-script.js', __FILE__), array('jquery'));
        wp_enqueue_script('my-admin-js');
    }
}

function show_and_save_login_logo() {
$error = 0;	
	//check image extensions
	if ( isset($_POST['logo']) ):
			$logoinfo = pathinfo($_POST['logo']);
			if ( strtolower($logoinfo['extension']) == 'jpg' || strtolower($logoinfo['extension']) == 'gif' || strtolower($logoinfo['extension']) == 'png' ):
				if ( ! copy( $_POST['logo'],'images/customized-login-logo.'.$logoinfo['extension']) ):
					$error = 1;
				endif;			
		else:
			$error = 1;
		endif;
		
	endif;//if ( isset($_POST['logo']) ):
	
	//Remove other format images if already exist
	$files = glob(ABSPATH.'wp-admin/images/customized-login-logo.*');
		if ( isset($files) && count($files) > 0 ):
			foreach ( $files as $file):
				$fileinfo = pathinfo($file);
				//Remove exist logo images except new uploaded logo
				if ( strtolower($fileinfo['extension']) !== strtolower($logoinfo['extension']) ) 
						 unlink($fileinfo['dirname'].'/'.$fileinfo['basename']);
			endforeach;
		endif;
		
echo $error;
die();	
}//function show_and_save_login_logo()
add_action('wp_ajax_show_and_save_login_logo', 'show_and_save_login_logo');
add_action('wp_ajax_nopriv_show_and_save_login_logo', 'show_and_save_login_logo');
?>