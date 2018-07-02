<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

// plugin activation required
require_once 'admin/requirements.php';

require_once 'fallback/custom-fields.php';
require_once 'custom-fields/index.php';

// require_once 'admin/hide-users-by-role.php';

/**
 * Adds admin screens and metaboxes.
 */
// if ( is_admin() ) {
  // Loads for users viewing the WordPress dashboard
  // if ( ! class_exists( 'Magic_Dashboard' ) ) {
    // require plugin_dir_path( __FILE__ ) . 'includes/class-dashboard.php';
  // }
// }

/**
 * Registration of CPT and related taxonomies.
 *
 * @since 0.0.1
 */
class Magic_Contact_Form {

  /**
   * Plugin version, used for cache-busting of style and script file references.
   *
   * @since 0.0.1
   *
   * @var string VERSION Plugin version.
   */
  const VERSION = '0.0.1';

  /**
   * Unique identifier for your plugin.
   *
   * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
   * match the Text Domain file header in the main plugin file.
   *
   * @since 0.0.1
   *
   * @var string
   */
  const PLUGIN_SLUG = 'magic_cf';

  /**
   * Initialize the plugin by setting localization and new site activation hooks.
   *
   * @since 0.0.1
   */
  public function __construct(  ) {

    require_once 'fallback/page-templates.php';

    $templates = array(
			'magic-contact-form-page.php' => 'Contact Page',
		);

    magic_page_templates($templates, plugin_dir_path( __FILE__ ) . 'templates/');

    // Load plugin text domain
    add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

    // load magic-dashboard if it does not exist.
    // this is needed for the message post_type to be attached to it.
    require_once 'fallback/magic-dashboard/magic-dashboard.php';

    require_once 'admin/dashboard/dashboard.php';
    add_action( 'admin_menu', 'magic_contact_form_dashboard' );

    require_once 'post/contact.php';
    add_action( 'admin_post_nopriv_magic_cf_send', 'magic_cf_send' );
    add_action( 'admin_post_magic_cf_send', 'magic_cf_send' );

    require_once 'styles/index.php';
    add_action( 'wp_enqueue_scripts', 'magic_cf_enqueue_styles' );

    require_once 'post_type/message.php';
    add_action( 'init', 'magic_cf_message_post_type' );

    // add the action
    add_action('wp_mail_failed', function ($wp_error) {
      return error_log(print_r($wp_error, true));
    }, 10, 1);
  }

  /**
   * Fired for each blog when the plugin is activated.
   *
   * @since 0.0.1
   */
  public function activate() {
    flush_rewrite_rules();
  }

  /**
   * Fired for each blog when the plugin is deactivated.
   *
   * @since 0.0.1
   */
  public function deactivate() {
    flush_rewrite_rules();
  }

  /**
   * Returns an instance of this class.
   */
  public static function get_instance() {

  	if( null == self::$instance ) {
  		self::$instance = new PageTemplater();
  	}

  	return self::$instance;

  }

  /**
   * Load the plugin text domain for translation.
   *
   * @since 0.0.1
   */
  public function load_plugin_textdomain() {
    $domain = self::PLUGIN_SLUG;
    load_plugin_textdomain( $domain, FALSE, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
  }
}
