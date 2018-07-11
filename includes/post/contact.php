<?php

// add_action( 'admin_post_nopriv_' . MAGIC_CONTACT_FORM_SEND_ACTION, 'magic_cf_send' );
// add_action( 'admin_post_' . MAGIC_CONTACT_FORM_SEND_ACTION, 'magic_cf_send' );

function magic_cf_send_message( array $context = [] ) {
  $arguments = array(
    'content' => 'missing_content',
    'subject' => 'missing_subject',
    'email' => 'missing_email',
    'username' => false,
  );

  $context = magic_parse_arguments( $arguments, $context );

  if ( !empty( $context['errors'] ) ) {
    return $context;
  }

  $post = array(
    'post_type' => MAGIC_CONTACT_FORM_POST_TYPE,
    'post_title' => $_POST['subject'],
  );

  if ( $user = get_current_user_id() ) {
    $post['post_author'] = $user;
  } else if ( $user = get_user_by( 'email', $email ) ) {
    $post['post_author'] = $user->ID;
  }

  if ( !empty( $user ) ) {
    $context['user'] = $user;
  }

  $post_id = wp_insert_post( $post, true );

  if ( is_wp_error( $post_id ) ) {
    $context['errors'][] = 'insert';
    return $context;
  }

  $post['title'] = $post_id;
  $post['ID'] = $post_id;

  $update_id = wp_update_post( $post );

  if ( is_wp_error( $update_id ) ) {
    $context['errors'][] = 'insert';
    return $context;
  }

  add_post_meta( $post_id, 'name', $context['query']['username'] );
  add_post_meta( $post_id, 'email', $context['query']['email'] );
  add_post_meta( $post_id, 'subject', $context['query']['subject'] );
  add_post_meta( $post_id, 'content', $context['query']['content'] );

  $from_name = magic_get_option('magic_contact_form_from_name');
  $from_email = magic_get_option('magic_contact_form_from_email');

  $headers = array(
    'From: ' . $from_name . ' <' . $from_email . '>',
    // 'Content-type: text/html',
  );

  $sent = wp_mail( $email, $subject, $content, $headers );

  // $mail_content = Timber::compile_string( 'teststring {{ test }} ', array( 'test' => 'yes' ) );
  // print($mail_content);
  // exit;

  if ( !$sent || is_wp_error( $sent ) ) {
    // error sending email.
    // we do not want to show these here,
    // instead there is an add_action in the plugin.php
    // $context['errors'][] = 'send_customer';
  }

  $sent_to_team = wp_mail( $from_email, $subject, $content, $headers );

  if (!$sent_to_team) {
    // error sending team email
    // we do not want to show these here,
    // instead there is an add_action in the plugin.php
    // $context['errors'][] = 'send_team';
  }

  if ( empty( $context['errors'] ) ) {
    $context['success'] = true;
  }


  return $context;
}
