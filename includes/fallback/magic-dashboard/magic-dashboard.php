<?php
if ( !function_exists( 'magic_dashboard' ) ) {
  function magic_dashboard() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Magic',
        'manage_options',
        'magic-dashboard',
        'magic_dashboard_render',
        'dashicons-carrot',
        25
    );
  }
  add_action( 'admin_menu', 'magic_dashboard' );

  if ( !function_exists( 'magic_dashboard_render' ) ) {
    function magic_dashboard_render() {
      $context = Timber::get_context();

      Timber::render( 'views/dashboard.twig', $context );
    }
  }
}

if ( !function_exists( 'magic_set_option') ) {
  function magic_set_option($name, $value) {
    if (function_exists( 'update_blog_option' ) ) {
      update_blog_option( null, $name, $value );
    } else {
      update_option( $name, $value );
    }
  }
}

if ( !function_exists( 'magic_get_option') ) {
  function magic_get_option($name, $default = '') {
    if (function_exists( 'get_blog_option' ) ) {
      $val = get_blog_option( null, $name );
    } else {
      $val = get_option( $name );
    }
    if (!$val) {
      return $default;
    }

    return $val;
  }
}
