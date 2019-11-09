<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Enqueue contact form css file
 */
require_once 'styles/index.php';

/**
 * Add Message post type
 */
require_once 'post_type/message.php';

/**
 * Add Admin Dashboard
 */
if ( is_admin() ) {
	require_once 'admin/dashboard.php';
	require_once 'admin/requirements.php';
}

/**
 * Add Contact Form Page templates to page templates
 */
add_action(
	'plugins_loaded',
	function () {
		if ( function_exists( 'magic_page_templates' ) ) {
			$templates = array(
				MAGIC_CONTACT_FORM_PAGE_TEMPLATE => 'Contact Page',
			);

			magic_page_templates( $templates, plugin_dir_path( __FILE__ ) . 'templates/' );

			require_once 'custom-fields/index.php';
		}
	}
);

// Load plugin text domain.
add_action(
	'init',
	function () {
		load_plugin_textdomain(
			MAGIC_CONTACT_FORM_SLUG,
			false,
			plugin_dir_path( __FILE__ ) . '/languages'
		);
	}
);

/**
 * Filter From Name for emails to get valid form Confirmation name
 */
add_filter(
	'wp_mail_from_name',
	function ( $original_email_from ) {
		return magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_from_name' );
	}
);

/**
 * Filter email address to get valid blog email address
 */
add_filter(
	'wp_mail_from',
	function ( $original_email_from ) {
		return magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_from_email' );
	}
);
