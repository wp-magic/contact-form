<?php
/**
 * Enqueue the css styles for this plugin
 *
 * @package MagicContactForm
 * @since 0.0.1
 */

add_action(
	'wp_enqueue_scripts',
	function () {
		magic_register_style( 'magic-cf', dirname( plugin_basename( __FILE__ ) ) );
	}
);
