<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

require_once 'fallback/index.php';
require_once 'custom-fields/index.php';

$templates = array(
	MAGIC_CONTACT_FORM_PAGE_TEMPLATE => 'Contact Page',
);

magic_page_templates($templates, plugin_dir_path( __FILE__ ) . 'templates/');

// Load plugin text domain
add_action( 'init', function () {
  load_plugin_textdomain(
    MAGIC_CONTACT_FORM_SLUG,
    FALSE,
    plugin_dir_path( __FILE__ ) . '/languages'
  );
} );

require_once 'post/contact.php';

require_once 'styles/index.php';

require_once 'post_type/message.php';
add_action( 'init', 'magic_cf_message_post_type' );

// add the action
add_action('wp_mail_failed', function ($wp_error) {
  return error_log(print_r($wp_error, true));
}, 10, 1);

if ( is_admin() ) {
	require_once 'admin/requirements.php';
	require_once 'admin/dashboard.php';
}
