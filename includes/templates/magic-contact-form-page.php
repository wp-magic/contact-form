<?php
/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */

$context = Timber::get_context();

$context['post'] = new TimberPost();

$request = magic_verify_nonce( MAGIC_CONTACT_FORM_SEND_ACTION );

if ( ! empty( $request ) ) {
	require_once 'requests/send-message.php';
	$context = magic_cf_send_message( $context, $request );
}

$context['form'] = array(
	'url'    => '',
	'action' => MAGIC_CONTACT_FORM_SEND_ACTION,
	'nonce'  => wp_create_nonce( MAGIC_CONTACT_FORM_SEND_ACTION ),
);

$user = wp_get_current_user();

if ( ! empty( $user ) ) {
	$context['query']['username'] = $user->display_name;
	$context['query']['email']    = $user->user_email;
}

Timber::render( 'views/contact.twig', $context );
