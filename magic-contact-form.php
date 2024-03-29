<?php
/**
 * Contact Form
 *
 * @package   Magic-Contact-Form
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Magic Contact Form
 * Plugin URI:
 * Description: Contact Form Plugin.
 * Version:     0.0.1
 * Author:      Jascha Ehrenreich
 * Author URI:  http://github.com/wp-magic/plugin-contact-form
 * Text Domain: magic_cf
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MAGIC_CONTACT_FORM_SLUG', 'magic_cf' );
define( 'MAGIC_CONTACT_FORM_PAGE_TEMPLATE', 'magic-contact-form-page.php' );
define( 'MAGIC_CONTACT_FORM_POST_TYPE', 'magic_cf_message' );

/**
 * Nonce slug for sending email using the form
 */
define( 'MAGIC_CONTACT_FORM_SEND_ACTION', 'magic_cf_send' );

/**
 * Include the actual functionality
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/plugin.php';
