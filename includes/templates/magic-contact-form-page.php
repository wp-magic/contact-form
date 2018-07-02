<?php

/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */

$context = Timber::get_context();

$context['post'] = new TimberPost();

$context['form'] = array(
  'url' => esc_url( admin_url('admin-post.php') ),
  'action' => 'magic_cf_send',
  'nonce' => wp_create_nonce('magic_cf_send'),
);

$context['_REQUEST'] = $_REQUEST;

if ( isset( $_REQUEST['error'] ) ) {
  $context['form']['error'] = $_REQUEST['error'];
}

if ($user = wp_get_current_user() ) {
  $context['name'] = $user->display_name;
  $context['email'] = $user->user_email;
}

Timber::render( 'views/contact.twig', $context );
