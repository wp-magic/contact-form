<?php
add_action(
	'wp_enqueue_scripts',
	function () {
		magic_register_style( 'magic-cf', dirname( plugin_basename( __FILE__ ) ) );
	}
);
