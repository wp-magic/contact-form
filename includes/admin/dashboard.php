<?php

add_action( 'admin_menu', function () {
  $title = 'Magic Contact Form Settings';

  $instructions = '
Every line has to end with a &lt;br&gt; tag.

You can use variables in this textarea:
<ul>
  <li>{{ customer_email }} - email of the customer</li>
  <li>{{ customer_name }} - name of the customer</li>
  <li>{{ email_subject }} - subject of the original email</li>
  <li>{{ email_content }} - content of the original email</li>
</ul>';

$team_email_text = '
Contact request received from: <br>
{{ customer_name}}<{{ customer_email }}><br>
<br>
Subject:<br>
{{ email_subject }}<br>
<br>
Content:<br>
{{ email_content }}<br>
';

  $customer_email_text = '
Hi, {{ customer_name }}.<br>
<br>
We got your email regarding {{ email_subject }}.<br>
<br>
Our team is on it and we will get back to you as soon as possible.<br>
<br>
Kind regards,<br>
ACME company Team<br>
';
  $settings = array(
    array(
      'type' => 'header',
      'name' => 'email_header',
      'value' => 'From Email Settings',
      'label' => 'This sets the email that replies to contact form mails',
    ),
    array(
      'name' => 'from_email',
      'type' => 'text',
      'default' => '',
      'label' => 'Mail sent from email',
    ),
    array(
      'name' => 'from_name',
      'type' => 'text',
      'default' => '',
      'label' => 'Mail sent from name',
    ),
    array(
      'name' => 'send_redirect',
      'type' => 'text',
      'default' => '',
      'label' => 'Where to connect the user to after sending the form. Empty value returns to contact form',
    ),

    array(
      'name' => 'customer_email_subject',
      'type' => 'text',
      'label' => 'Email subject for the customer',
      'default' => 'Thanks for your contact request, {{ customer_name }}',
      'instructions' => $instructions,
    ),
    array(
      'name' => 'customer_email_text',
      'type' => 'textarea',
      'rows' => 10,
      'label' => 'Email sent to customers',
      'instructions' => $instructions,
      'default' => $customer_email_text,
    ),
    array(
      'name' => 'team_email_subject',
      'type' => 'text',
      'label' => 'Email subject for the team',
      'default' => 'Email received from {{ customer_email }}',
      'instructions' => $instructions,
    ),
    array(
      'name' => 'team_email_text',
      'type' => 'textarea',
      'rows' => 10,
      'label' => 'Email sent to the team',
      'default' => $team_email_text,
      'instructions' => $instructions,
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
