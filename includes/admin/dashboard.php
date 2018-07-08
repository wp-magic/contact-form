<?php

add_action( 'admin_menu', function () {
  $title = 'Magic Contact Form Settings';

  $settings = array(
    array(
      'type' => 'header',
      'name' => 'from_email_header',
      'value' => 'From Email Settings',
      'label' => 'This sets the email that replies to contact form mails',
    ),
    array(
      'name' => 'magic_contact_form_from_email',
      'type' => 'text',
      'default' => '',
      'label' => 'Mail sent from email',
    ),
    array(
      'name' => 'magic_contact_form_from_name',
      'type' => 'text',
      'default' => '',
      'label' => 'Mail sent from name',
    ),
    array(
      'name' => 'magic_cf_send_redirect',
      'type' => 'text',
      'default' => '',
      'label' => 'Where to connect the user to after sending the form. Empty value returns to contact form',
    ),
  );

  magic_dashboard_add_submenu_page( array (
    'link' => 'Settings',
    'slug' => MAGIC_CONTACT_FORM_SLUG,
    'title' => $title,
    'settings' => $settings,
    'parent' => 'edit.php?post_type=' . MAGIC_CONTACT_FORM_POST_TYPE,
   ) );
}, 2 );
