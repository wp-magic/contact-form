<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

require_once 'styles/index.php';
require_once 'post_type/message.php';

if ( is_admin() ) {
	require_once 'admin/dashboard.php';
	require_once 'admin/requirements.php';
}

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

// Load plugin text domain
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

add_filter(
	'wp_mail_from_name',
	function ( $original_email_from ) {
		return magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_from_name' );
	}
);

add_filter(
	'wp_mail_from',
	function ( $original_email_from ) {
		return magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_from_email' );
	}
);
