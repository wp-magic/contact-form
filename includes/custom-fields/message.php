<?php
if ( function_exists( 'magic_register_field_group' ) ) {
	magic_register_field_group(
		array(
			'id'       => 'acf_magic-cf-message',
			'title'    => 'Magic Message',
			'slug'     => 'magic_cf_message',
			'fields'   => array(
				'subject' => array(
					'label'        => 'Subject',
					'type'         => 'text',
					'instructions' => 'Message subject',
				),
				'email'   => array(
					'label'        => 'Email',
					'type'         => 'email',
					'instructions' => 'Email of the user sending this message',
				),
				'name'    => array(
					'label'        => 'Customer name',
					'type'         => 'text',
					'instructions' => 'Name the user wants to be addressed with',
				),
				'content' => array(
					'label'        => 'Message Content',
					'type'         => 'wysiwyg',
					'instructions' => 'Message content',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'magic_cf_message',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'  => array(
				'position'       => 'normal',
				'layout'         => 'display',
				'hide_on_screen' => array(
					0 => 'permalink',
					1 => 'the_content',
					2 => 'excerpt',
					3 => 'custom_fields',
					4 => 'discussion',
					5 => 'comments',
					6 => 'author',
					7 => 'featured_image',
					8 => 'categories',
					9 => 'tags',
				),
			),
		)
	);
}
