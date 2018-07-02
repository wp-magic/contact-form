<?php

function magic_contact_form_settings_field( array $args ) {
    $type    = $args['type'] || 'text';
    $id      = $args['id'] || '';
    $default = $args['default'] || '';

    $data   = get_option( $id, $default );
    $value  = esc_attr($data);

    print "<input type='$type' value='$value' name='$id' id='$id' />";
}

function magic_contact_form_dashboard() {
  add_submenu_page(
    'magic-dashboard',
    'Contact Form',
    'Contact Form',
    'manage_options',
    'magic_contact_form',
    'magic_contact_form_dashboard_render'
  );
}


function magic_contact_form_dashboard_create_settings( array $settings ) {
  $conf = array();
  foreach ( $settings as $setting ) {
    $name = $setting['name'];
    $conf[$name] = $setting;
    $conf[$name]['value'] = magic_get_option( $name );
  }

  return $conf;
}

function magic_contact_form_dashboard_render() {
  $settings = array(
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
  );

  $context = Timber::get_context();

  if ($_POST) {
    foreach ( $settings as $setting ) {
      $name = $setting['name'];
      if ( isset( $_POST[$name] ) ) {
        $value = $_POST[$name];
        if ( $value == '') {
          $value = '/';
        }

        magic_set_option( $name, $value );
      }
    }
  }

  $context['settings'] = magic_contact_form_dashboard_create_settings( $settings );

  Timber::render( 'views/dashboard.twig', $context );
}
