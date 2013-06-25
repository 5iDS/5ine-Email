<?php
/* 
Plugin Name: Mighty Fine Email 
Description: A more respectable approach to WP EMails.
Version: 0.5.0
Author: ...a few good HipHoppers...
Author URI: http://www.5ivedesign.co.za
*/


#-----------------------------------------------------------------
# Preparing The WordPress System For Our Emails
#-----------------------------------------------------------------
add_filter ("wp_mail_content_type", "html_mail_content_type");
function html_mail_content_type() {
	return "text/html";
}
add_filter('wp_mail_from', 'new_mail_from');
function new_mail_from($old) {
	$wpfrom = get_option('admin_email');
	return $wpfrom;
}
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from_name($old) {
	$wpfrom = get_option('blogname');
	return $wpfrom;
}

#-----------------------------------------------------------------
# NEW USER NOTIFICATION FUNCTION REDEFINED
#-----------------------------------------------------------------
if ( !function_exists('wp_new_user_notification') ) {

    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {

		$user = new WP_User($user_id);
		
		$user_login = stripslashes($user->user_login);
		$user_email = stripslashes($user->user_email);
	
		$email_subject = "Welcome to ".get_option('blogname')." ".$user_login.".";


		ob_start();
		
		include("email_template_header.php");
		
		?>

		<p><?php _e('A very special welcome to you','fids');?>,&nbsp;<?php echo $user_login ?>, <?php _e('Thank you for using','fids');?>&nbsp;<?php bloginfo('name');?>.&nbsp;<?php _e('Now that your invite is up and running; Log into your personalised dashboard with your email address','fids');?>&nbsp;<?php echo "($user_email)";?>&nbsp;<?php _e('through the following link:','fids');?>&nbsp;<?php bloginfo("url"); ?>/myrplyz .</p><br />
	
		<p><?php _e('Your password is','fids');?><strong style="color:orange"><?php echo $plaintext_pass ?></strong> <br><?php _e('Please keep it secret and keep it safe!','fids');?></p>
	
		<p><?php _e('We hope you enjoy your stay at','fids');?>&nbsp;<?php bloginfo('name');?>. <?php _e('If you have any problems, questions, opinions, praise, comments, suggestions, please feel free to contact us at any time.','fids');?></p>
		<br />
		<?php
		
		include("email_template_footer.php");
		
		$message = ob_get_contents();
		
		ob_end_clean();

		//NOTIFY USER
		wp_mail($user_email, $email_subject, $message);

		//NOTIFY ADMIN
		@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;
    }
}

#-----------------------------------------------------------------
# PASSWORD RETRIEVAL EMAILS
#-----------------------------------------------------------------
add_filter ("retrieve_password_title", "mighty5ine_retrieve_password_title");
function mighty5ine_retrieve_password_title() {
	return "Password Reset for ".get_option('blogname')."";
}

add_filter ("retrieve_password_message", "mighty5ine_retrieve_password_message");
function mighty5ine_retrieve_password_message($content, $key) {
	
	global $wpdb;
	$user_login = $wpdb->get_var("SELECT user_login FROM $wpdb-<users WHERE user_activation_key = '$key'");
	
	ob_start();
	
	$email_subject = mighty5ine_retrieve_password_title();
	
	include("email_template_header.php");
	?>
	
	<p>
		<?php _e('It likes like you (hopefully) want to reset your password for your MyAwesomeWebsite.com account.','fids');?>
	</p>

	<p>
		<?php _e('To reset your password, visit the following address, otherwise just ignore this email and nothing will happen.','fids');?>
		<br>
		<?php echo wp_login_url("url"); ?>?action=rp&key=<?php echo $key; ?>&login=<?php echo $user_login; ?>		
	<p>

	<?php
	include("email_template_footer.php");
	
	$message = ob_get_contents();

	ob_end_clean();
  
	return $message;
}

#-----------------------------------------------------------------
# Notify Invitation authors of comments:
#-----------------------------------------------------------------

#-----------------------------------------------------------------
# Notify Password changes
#-----------------------------------------------------------------

/*
		global $wpdb;
		
		$table_name = $wpdb->prefix . "bp_xprofile_data";	
		
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
		
		//XPROFILE FIELDS
		$id_elan_name = 1;
		$id_elan_surname = 11;
		$id_elan_id = 12;
		$id_user_rsa_id = 13;
		$id_user_cellphone = 14;
		$id_user_address = 18;
		$id_user_postal_code = 19;
		$id_user_country = 20;
		$id_user_region = 21;
		
		
$elan_name = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_elan_name."");
$elan_surname = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_elan_surname."");
$elan_id = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_elan_id."");
$user_rsa_id = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_user_rsa_id."");
$user_cellphone = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_user_cellphone."");
$user_address = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_user_address."");
$user_postal_code = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_user_postal_code."");
$user_country = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_user_country."");
$user_region = $wpdb->get_var("SELECT value FROM ".$table_name." WHERE user_id = ".$user_id." AND field_id = ".$id_user_region."");
		
		
        $message  = sprintf(__('New user enrolment on your website %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
		$message .= sprintf(__('User first name %s'), $elan_name) . "\r\n";
		$message .= sprintf(__('User last name: %s'), $elan_surname) . "\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";
		$message .= sprintf(__('User contact no.: %s'), $user_cellphone) . "\r\n";
		$message .= sprintf(__('Elan no.: %s'), $elan_id) . "\r\n";
		$message .= sprintf(__('User ID no.: %s'), $user_rsa_id) . "\r\n";
		$message .= sprintf(__('User address: %s'), $user_address) . "\r\n";
		$message .= sprintf(__('User region: %s'), $user_region) . "\r\n";
		$message .= sprintf(__('User country: %s'), $user_country) . "\r\n";
		$message .= sprintf(__('User code: %s'), $user_postal_code) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;
		
		*/
?>
