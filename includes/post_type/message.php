<?php
/**
 * Message Post Type
 *
 * @package  Magic_Contact_Form
 * @license   GPL-2.0+
 */

/**
 * Register the custom post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', function () {
  $labels = array(
    'name'               => __( 'Messages', 'magic_cf' ),
    'singular_name'      => __( 'Message', 'magic_cf' ),
    'add_new'            => __( 'Add Message', 'magic_cf' ),
    'add_new_item'       => __( 'Add Message', 'magic_cf' ),
    'edit_item'          => __( 'Edit Message', 'magic_cf' ),
    'new_item'           => __( 'New Message', 'magic_cf' ),
    'view_item'          => __( 'View Message', 'magic_cf' ),
    'search_items'       => __( 'Search Message', 'magic_cf' ),
    'not_found'          => __( 'No messages found', 'magic_cf' ),
    'not_found_in_trash' => __( 'No messages in the trash', 'magic_cf' ),
  );

  $supports = array(
    'title',
    'editor',
    'comments',
  );

  $args = array(
    'labels'          => $labels,
    'supports'        => $supports,
    'rewrite'         => array('slug' => __('message', 'magic_cf')),
    'menu_position'   => 30,
    'menu_icon'       => 'dashicons-id',
    // 'show_in_menu'    => MAGIC_DASHBOARD_SLUG,
    'public' => true,  // it's not public, it shouldn't have it's own permalink, and so on
    'publicly_queryable' => true,  // you should be able to query it
    'show_ui' => true,  // you should be able to edit it in wp-admin
    'exclude_from_search' => false,  // you should exclude it from search results
    'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
    'has_archive' => false,
    'can_export' => true,
    // 'capabilities' => array(
    //   'edit_post' => 'edit_message',
    //   'edit_posts' => 'edit_messages',
    //   'edit_others_posts' => 'edit_other_messages',
    //   'publish_posts' => 'publish_messages',
    //   'read_post' => 'read_message',
    //   'read_private_posts' => 'read_private_messages',
    //   'delete_post' => 'delete_message'
    // ),
    // 'map_meta_cap' => true,
  );

  register_post_type( MAGIC_CONTACT_FORM_POST_TYPE, $args );
} );

  // /**
  //  * Register a taxonomy for Message Categories.
  //  *
  //  * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
  //  */
  // function magic_cf_message_post_type_taxonomy() {
  //   $labels = array(
  //     'name'                       => __( 'Message Categories', 'magic_cf' ),
  //     'singular_name'              => __( 'Message Category', 'magic_cf' ),
  //     'menu_name'                  => __( 'Message Categories', 'magic_cf' ),
  //     'edit_item'                  => __( 'Edit Message Category', 'magic_cf' ),
  //     'update_item'                => __( 'Update Message Category', 'magic_cf' ),
  //     'add_new_item'               => __( 'Add New Message Category', 'magic_cf' ),
  //     'new_item_name'              => __( 'New Message Category Name', 'magic_cf' ),
  //     'parent_item'                => __( 'Parent Message Category', 'magic_cf' ),
  //     'parent_item_colon'          => __( 'Parent Message Category:', 'magic_cf' ),
  //     'all_items'                  => __( 'All Message Categories', 'magic_cf' ),
  //     'search_items'               => __( 'Search Message Categories', 'magic_cf' ),
  //     'popular_items'              => __( 'Popular Message Categories', 'magic_cf' ),
  //     'separate_items_with_commas' => __( 'Separate message categories with commas', 'magic_cf' ),
  //     'add_or_remove_items'        => __( 'Add or remove message categories', 'magic_cf' ),
  //     'choose_from_most_used'      => __( 'Choose from the most used message categories', 'magic_cf' ),
  //     'not_found'                  => __( 'No message categories found.', 'magic_cf' ),
  //   );
  //
  //   $args = array(
  //     'labels'            => $labels,
  //     'public'            => true,
  //     'show_in_nav_menus' => false,
  //     'show_ui'           => true,
  //     'show_tagcloud'     => false,
  //     'hierarchical'      => false,
  //     'rewrite'           => array( 'slug' => 'message_category' ),
  //     'show_admin_column' => true,
  //     'query_var'         => true,
  //   );
  //
  //   $args = apply_filters( 'message_post_type_category_args', $args );
  //
  //   register_taxonomy( $this->taxonomy, MAGIC_CONTACT_FORM_POST_TYPE, $args );
  // }
