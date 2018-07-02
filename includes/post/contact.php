<?php

function magic_cf_send() {
  $ref = $_SERVER['HTTP_REFERER'];

  $post = array(
    'post_type' => 'magic_cf_message'
  );

  $content = sanitize_post_field( 'content', trim( $_POST['content'] ), 'db' );
  $subject = sanitize_post_field( 'post_title', trim( $_POST['subject'] ), 'db' );
  $name = esc_attr( trim( $_POST['name'] ) );
  $email = esc_attr( trim( $_POST['email'] ) );

  if( !wp_verify_nonce( $_POST['nonce'], 'magic_cf_send' ) ) {
    $error = 'nonce';
  } else if ( empty( $email ) ) {
    $error = 'email';
  } else if ( empty( $subject ) && empty( $content ) ) {
    $error = 'content';
  }

  if ( !empty( $error ) ) {
    $ref = add_query_arg( 'error', $error, $ref );

    $ref = add_query_arg( 'email', $email, $ref );
    $ref = add_query_arg( 'message', $post['content'], $ref );
    $ref = add_query_arg( 'subject', $subject, $ref );
    $ref = add_query_arg( 'name', $name, $ref );

    wp_redirect( $ref );
    exit;
  }

  if ( $user = get_current_user_id() ) {
    $post['post_author'] = $user;
  } else if ( $user = get_user_by( 'email', $email ) ) {
    $post['post_author'] = $user->ID;
  }

  $post_id = wp_insert_post( $post, true );
  $update_id = wp_update_post($post_id, array( 'post_title' => $post_id ) );

  add_post_meta( $post_id, 'name', $name );
  add_post_meta( $post_id, 'email', $email );
  add_post_meta( $post_id, 'subject', $subject );
  add_post_meta( $post_id, 'content', $content );

  if (is_wp_error( $post_id ) ) {
    $ref = add_query_arg( 'error', 'insert', $ref );

    $ref = add_query_arg( 'email', $email, $ref );
    $ref = add_query_arg( 'message', $content, $ref );
    $ref = add_query_arg( 'subject', $subject, $ref );
    $ref = add_query_arg( 'name', $name, $ref );

    wp_redirect( $ref );
    exit;
  }

  $ref = add_query_arg( 'success', true, $ref );

  $from_name = magic_get_option('magic_contact_form_from_name');
  $from_email = magic_get_option('magic_contact_form_from_email');

  $headers = array(
    'From: ' . $from_name . ' <' . $from_email . '>',
  );

  $sent = wp_mail( $email, $subject, $content, $headers );

  if (!$sent) {
    // error sending email.
  }

  $sent_to_team = wp_mail( $from_email, $subject, $content, $headers );

  if (!$sent_to_team) {
    // error sending team email
  }

  wp_redirect( magic_get_option( 'magic_cf_send_redirect', $ref ) );
  exit;
}
