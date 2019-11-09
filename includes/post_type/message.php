<?php
/**
 * Message Post Type
 *
 * @package  MagicContactForm
 * @since 0.0.1
 */

/**
 * Register the custom post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @since 0.0.1
 */

add_action(
	'init',
	function () {
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
			'labels'              => $labels,
			'supports'            => $supports,
			'rewrite'             => array( 'slug' => __( 'message', 'magic_cf' ) ),
			'menu_position'       => 30,
			'menu_icon'           => 'dashicons-id',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'exclude_from_search' => false,
			'show_in_nav_menus'   => false,
			'has_archive'         => false,
			'can_export'          => true,
		);

		register_post_type( MAGIC_CONTACT_FORM_POST_TYPE, $args );
	}
);
