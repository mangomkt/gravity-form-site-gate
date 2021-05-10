<?php
/*
Plugin Name: Gravity Form Gate
Plugin URI: https://www.github.com
Description: This plugin provides a way to gate your site using a gravity form.
Author: Curtis Grant
Author URI: https://www.mangomkt.com/
Version: 0.1
*/

//WP Admin Setting Page
include_once( 'lib/gfsg_admin.php');

function my_logged_in_redirect() {
    if(((get_option('gfg_form_id')) && get_option('gfg_page_id'))) { 
		$page_ID = get_option('gfg_page_id');
		if ( !is_user_logged_in() && !is_page( $page_ID ) && !isset($_COOKIE['gf_gate'])) {
			wp_redirect( get_permalink( $page_ID ) );
			die;
		}
	}     
}
add_action( 'template_redirect', 'my_logged_in_redirect' );

add_filter( 'gform_confirmation', 'custom_confirmation', 10, 4 );
function custom_confirmation( $confirmation, $form, $entry, $ajax ) {
	if(((get_option('gfg_form_id')) && get_option('gfg_page_id'))) {
		$form_ID = get_option('gfg_form_id');
		if( $form['id'] == $form_ID ) {
			setcookie( 'gf_gate', 'true', time()+31556926 ,'/');
		}
    }
    return $confirmation;
}

?>