<?php
/*
Plugin Name: Change Login Screen
Plugin URI: http://trinetsource.com/download-change-login-screen-plugin/
Description: Change wordpress default login screen into customized look.You can change the default wordpress logo through wordpress media library or uploading from your computer.
Version: 1.0
Author: M Nazmul
Author URI: http://www.trinetsource.com/
License: General Public License ( GPL )
*/

/*

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/* changing the login header URL */

  	function mnh_login_logo_url() {
    return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'mnh_login_logo_url' );

/* changing the login page URL hover text */

	function mnh_login_logo_url_title() {
	return get_bloginfo( 'title' );
	}
	add_filter( 'login_headertitle', 'mnh_login_logo_url_title' );
	
	
	
/* changing the "Register For This Site" message */
	function mnh_change_login_message($message) 
	{
		// change messages that contain 'Register' 
		if (strpos($message, 'Sign Up') !== FALSE) {
			$newMessage = 'Welcome to <b>'.get_bloginfo('title').'</b>.Register with us just providing username and e-mail.';
			return '<p class="message register">' . $newMessage . '</p>';
		}
		else {
			return $message;
		}
	}
 
	/* add our new function to the login_message hook */
	add_action('login_message', 'mnh_change_login_message');



/* Change Text Register to Sign Up in login page */
add_filter(  'gettext',  'mnh_register_text'  );
add_filter(  'ngettext',  'mnh_register_text'  );
function mnh_register_text( $translated ) {
     $translated = str_ireplace(  'Register',  'Sign Up',  $translated );
     return $translated;
}


/* Change Text Lost your password? into Forgot Password? */
add_filter( 'gettext', 'mnh_change_lostpassword_text' );
add_filter(  'ngettext',  'mnh_change_lostpassword_text');
function mnh_change_lostpassword_text ( $translated ) {
	 	$translated = str_ireplace('Lost your password?' , 'Forgot Password?',$translated);
		return $translated;
	 }	
	
	
function mnh_get_logo_image() {
	$imageurl = ABSPATH.'wp-admin/images/';
	if ( file_exists($imageurl.'customized-login-logo.jpg') ):
		$showlogo = "customized-login-logo.jpg";
	elseif ( file_exists( $imageurl.'customized-login-logo.png') ):
		$showlogo = "customized-login-logo.png";
	elseif ( file_exists( $imageurl.'customized-login-logo.gif') ):
		$showlogo = "customized-login-logo.gif";
	else:
	      //when no logo image found then show default wordpress image		  
		  $wpdefaultlogo = plugin_dir_path(__FILE__).'/wp-badge.png';
		  if ( copy( $wpdefaultlogo, ABSPATH.'wp-admin/images/customized-login-logo.png' ) ):
		  	$showlogo = 'customized-login-logo.png';
		  else:
		  	$showlogo = "";
		  endif; 
	endif;
	return $showlogo;		
} //function mnh_get_logo_image()

/* Change Login Screen For best result use 250 X 250 pixel logo */

function mnh_custom_login_logo() {

$showlogo = mnh_get_logo_image();	
echo '<style type="text/css">
.login h1 a { 
	background-image: url('.get_bloginfo('wpurl').'/wp-admin/images/'.$showlogo.') !important; 
	background-size: 250px 250px !important;
	display: block; 
	height: 250px; 
	overflow: hidden; 
	padding-bottom: 10px; 
	text-indent: -9999px; 
	width: 250px; 
	margin: 0 auto; 
}
html, body.login { 
	background: none repeat scroll 0 0 #72a7cf;
	min-width: 0;  
}
#login { 
	padding: 10px 0 0!important;
	width: 30%;
}
.login form {
	background: rgb(76,76,76); 
	background: -moz-linear-gradient(top,  rgba(76,76,76,1) 0%, rgba(44,44,44,1) 38%, rgba(0,0,0,1) 39%, rgba(19,19,19,1) 100%); 
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(76,76,76,1)), color-stop(38%,rgba(44,44,44,1)), color-stop(39%,rgba(0,0,0,1)), color-stop(100%,rgba(19,19,19,1))); 
	background: -webkit-linear-gradient(top,  rgba(76,76,76,1) 0%,rgba(44,44,44,1) 38%,rgba(0,0,0,1) 39%,rgba(19,19,19,1) 100%); 
	background: -o-linear-gradient(top,  rgba(76,76,76,1) 0%,rgba(44,44,44,1) 38%,rgba(0,0,0,1) 39%,rgba(19,19,19,1) 100%); 
	background: -ms-linear-gradient(top,  rgba(76,76,76,1) 0%,rgba(44,44,44,1) 38%,rgba(0,0,0,1) 39%,rgba(19,19,19,1) 100%); 
	background: linear-gradient(top,  rgba(76,76,76,1) 0%,rgba(44,44,44,1) 38%,rgba(0,0,0,1) 39%,rgba(19,19,19,1) 100%); 
 	border: 1px solid #E5E5E5; -moz-border-radius: 15px 15px 15px 15px; -webkit-border-radius: 15px 15px 15px 15px; border-radius: 15px 15px 15px 15px; box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5); font-weight: normal; margin-left: 8px; padding: 26px 24px 46px; 
}
.login .button-primary { 
	padding: 5px 25px !important;
}
input.button-primary, button.button-primary, a.button-primary {
	background: rgb(117,174,255); 
	background: -moz-linear-gradient(top,  rgba(117,174,255,1) 0%, rgba(117,174,255,1) 35%, rgba(66,142,255,1) 65%, rgba(66,142,255,1) 100%); 
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(117,174,255,1)), color-stop(35%,rgba(117,174,255,1)), color-stop(65%,rgba(66,142,255,1)), color-stop(100%,rgba(66,142,255,1))); 
	background: -webkit-linear-gradient(top,  rgba(117,174,255,1) 0%,rgba(117,174,255,1) 35%,rgba(66,142,255,1) 65%,rgba(66,142,255,1) 100%); 
	background: -o-linear-gradient(top,  rgba(117,174,255,1) 0%,rgba(117,174,255,1) 35%,rgba(66,142,255,1) 65%,rgba(66,142,255,1) 100%); 
	background: -ms-linear-gradient(top,  rgba(117,174,255,1) 0%,rgba(117,174,255,1) 35%,rgba(66,142,255,1) 65%,rgba(66,142,255,1) 100%); 
	background: linear-gradient(top,  rgba(117,174,255,1) 0%,rgba(117,174,255,1) 35%,rgba(66,142,255,1) 65%,rgba(66,142,255,1) 100%); border: none !important; color: #FFFFFF; font-weight: bold; text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
}	
input.button-primary:hover, button.button-primary:hover, a.button-primary:hover, input.button-primary:active, button.button-primary:active, a.button-primary:active {
	background: rgb(66,142,255); 
	background: -moz-linear-gradient(top,  rgba(66,142,255,1) 0%, rgba(66,142,255,1) 35%, rgba(117,174,255,1) 65%, rgba(117,174,255,1) 100%); 									
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(66,142,255,1)), color-stop(35%,rgba(66,142,255,1)), color-stop(65%,rgba(117,174,255,1)), color-stop(100%,rgba(117,174,255,1))); 
	background: -webkit-linear-gradient(top,  rgba(66,142,255,1) 0%,rgba(66,142,255,1) 35%,rgba(117,174,255,1) 65%,rgba(117,174,255,1) 100%); 	
	background: -o-linear-gradient(top,  rgba(66,142,255,1) 0%,rgba(66,142,255,1) 35%,rgba(117,174,255,1) 65%,rgba(117,174,255,1) 100%); 
	background: -ms-linear-gradient(top,  rgba(66,142,255,1) 0%,rgba(66,142,255,1) 35%,rgba(117,174,255,1) 65%,rgba(117,174,255,1) 100%); 
	background: linear-gradient(top,  rgba(66,142,255,1) 0%,rgba(66,142,255,1) 35%,rgba(117,174,255,1) 65%,rgba(117,174,255,1) 100%); 
}
.login #nav { 
	float: left; 
	margin: 0 0 0 16px; 
	padding: 10px 0 0; 
	text-shadow: 0 1px 0 #FFFFFF; 
	width: 250px;
}
.login #nav a { 
	/*color: #CF0404 !important; */
	color: #EFEFEF; 
	text-decoration: none; 
	/*display: block; */
	min-height: 20px; 
	height: auto !important;
	width: 120px;
	-moz-text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3); 
	-webkit-text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3); 
	text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3);  
	padding: 5px 0 0 10px; 
}
.login #nav a:hover, .login #nav a:active  { 
	background-color: #cf0404; 
	-moz-border-radius: 5px 5px 5px 5px;  
	-webkit-border-radius: 5px 5px 5px 5px; 
	 border-radius: 5px 5px 5px 5px; color: #F2F2F2 !important; 
	 text-decoration: none; 
	 /*display: block; */
	 min-height: 20px; 
	 height: auto !important; 
	 width: 120px; 
	 -moz-text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
	 -webkit-text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
	 text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
	 padding: 5px 0 5px 10px;	 
	}
.login #backtoblog { 
	float: left; 
	margin: 0 0 0 16px; 
	padding: 10px 0 0; 
	text-shadow: 0 1px 0 #FFFFFF; 
	width: 110px; 
}
.login #backtoblog a { 
	display: block; 
	/*color: #428EFF !important;*/
	color: #EFEFEF; 
	text-decoration: none; 
	-moz-text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3); 
	-webkit-text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3); 
	text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3); 
	padding: 5px 0 0 0; 
	width: 120px; 
	min-height: 20px; 
	height: auto !important;
}
.login #backtoblog a:hover, .login #backtoblog a:active { 
	background-color: #428EFF; 
	display: block; 
	min-height: 20px; 
	height: auto !important; 
	width: 120px; 
	-moz-border-radius: 5px;  
	-webkit-border-radius: 5px;  
	border-radius: 5px; 
	color: #F2F2F2 !important;
	text-decoration: none;  
	-moz-text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
	-webkit-text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3); 
	padding: 5px 0 0 0;
}
 </style>';
}

add_action('login_head', 'mnh_custom_login_logo');
include_once 'login-logo.php';
?>