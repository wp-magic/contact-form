<?php
/**
 * Actually send a message from a user
 *
 * @package MagicContactForm
 * @since 0.0.1
 */

/**
 * Actually send a message.
 *
 * @since 0.0.1
 *
 * @param array $context timber context.
 * @param array $request $_POST data.
 *
 * @return array $context timber context enhanced by email results.
 */
function magic_cf_send_message( array $context = [], array $request = [] ) {
	$arguments = array(
		'content'  => 'missing_content',
		'subject'  => 'missing_subject',
		'email'    => 'missing_email',
		'username' => false,
	);

	$context = magic_parse_arguments( $arguments, $context );

	if ( ! empty( $context['errors'] ) ) {
		return $context;
	}

	$post = array(
		'post_type'   => MAGIC_CONTACT_FORM_POST_TYPE,
		'post_title'  => $request['subject'],
		'post_status' => 'public',
	);

	$user_id = get_current_user_id();

	if ( ! empty( $user_id ) ) {
		$post['post_author'] = $user;
	} else {
		$user_by_email = get_user_by( 'email', $context['query']['email'] );

		if ( ! empty( $user_by_email ) ) {
			$post['post_author'] = $user->ID;
		}
	}

	if ( ! empty( $user ) ) {
		$context['user'] = $user;
	}

	$post_id = wp_insert_post( $post, true );

	if ( is_wp_error( $post_id ) ) {
		$context['errors'][] = 'insert';
		return $context;
	}

	$post['title'] = $post_id;
	$post['ID']    = $post_id;

	$update_id = wp_update_post( $post );

	if ( is_wp_error( $update_id ) ) {
		$context['errors'][] = 'insert';
		return $context;
	}

	add_post_meta( $post_id, 'name', $context['query']['username'] );
	add_post_meta( $post_id, 'email', $context['query']['email'] );
	add_post_meta( $post_id, 'subject', $context['query']['subject'] );
	add_post_meta( $post_id, 'content', $context['query']['content'] );

	if ( function_exists( 'ThreeWP_Broadcast' ) ) {
		ThreeWP_Broadcast()->api()->broadcast_children( $post_id, [ 1, 2 ] );
	}

	$from_name  = magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_from_name' );
	$from_email = magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_from_email' );

	$headers = 'MIME-Version: 1.0\r\n' .
	'Content-Type: text/plain; charset="' . get_option( 'blog_charset' ) . '"\r\n';

	$query = $context['query'];

	$email    = $query['email'];
	$username = $query['username'];
	$subject  = $query['subject'];
	$content  = $query['content'];

	$email_ctx = array(
		'customer_email' => $email,
		'customer_name'  => ! empty( $username ) ? $username : $email,
		'email_subject'  => $subject,
		'email_content'  => $content,
	);

	$customer_email_subject = magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_customer_email_subject' );
	$customer_email_subject = Timber::compile_string( $customer_email_subject, $email_ctx );

	$customer_email_text    = magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_customer_email_text' );
	$customer_email_content = Timber::compile_string( $customer_email_text, $email_ctx );

	$sent = wp_mail(
		$context['query']['email'],
		$customer_email_subject,
		$customer_email_content,
		$headers
	);

	$team_email_subject = magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_team_email_subject' );
	$team_email_subject = Timber::compile_string( $customer_email_subject, $email_ctx );

	$team_email_text    = magic_get_option( MAGIC_CONTACT_FORM_SLUG . '_team_email_text' );
	$team_email_content = Timber::compile_string( $team_email_text, $email_ctx );

	$sent_to_team = wp_mail(
		$from_email,
		$team_email_subject,
		$team_email_content,
		$headers
	);

	if ( empty( $context['errors'] ) ) {
		$context['success'] = true;
	}

	return $context;
}
