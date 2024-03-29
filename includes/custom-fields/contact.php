<?php
/**
 * Add Admin Custom Fields for Magic Contact Form Page Template
 *
 * @package MagicContactForm
 * @since 0.0.1
 */

if ( function_exists( 'magic_register_field_group' ) ) {
	magic_register_field_group(
		array(
			'id'       => 'afc_magic_contact_form_page',
			'title'    => 'Magic Contact Form Page',
			'slug'     => 'magic_cf',
			'fields'   => array(
				'tab_page_text'         => array(
					'label' => 'Page Text',
					'type'  => 'tab',
				),
				'above_text'            => array(
					'label' => 'Text above form',
					'type'  => 'wysiwyg',
				),
				'username_placeholder'  => array(
					'label'         => 'name placeholder text',
					'type'          => 'text',
					'default_value' => 'Your name',
				),
				'email_placeholder'     => array(
					'label'         => 'email placeholder text',
					'type'          => 'text',
					'default_value' => 'Your email',
				),
				'subject_placeholder'   => array(
					'label'         => 'subject placeholder text',
					'type'          => 'text',
					'default_value' => 'Subject',
				),
				'content_placeholder'   => array(
					'label'         => 'content placeholder text',
					'type'          => 'text',
					'default_value' => 'Your message',
				),
				'submit_text'           => array(
					'label'         => 'submit button text',
					'type'          => 'text',
					'default_value' => 'Send',
				),
				'success_message'       => array(
					'label'         => 'Message sent text',
					'type'          => 'wysiwyg',
					'default_value' => 'Message sent successfully. We will get back to you as soon as possible.',
				),
				'below_text'            => array(
					'label' => 'Text below form',
					'type'  => 'wysiwyg',
				),

				'tab_form_errors'       => array(
					'label' => 'Form Errors',
					'type'  => 'tab',
				),
				'error_nonce'           => array(
					'label'         => 'Nonce error text',
					'type'          => 'text',
					'default_value' => 'Nonce error. Please retry.',
					'instructions'  => 'nonces are a security feature. If they error it likely means that we have a cross site request forgery going on.',
				),
				'error_missing_email'   => array(
					'label'         => 'Email Missing Text',
					'type'          => 'text',
					'default_value' => 'Email missing',
					'instructions'  => 'Shown if the user adds no email to the form',
				),
				'error_missing_content' => array(
					'label'         => 'Content Missing Text',
					'type'          => 'text',
					'default_value' => 'Content missing',
					'instructions'  => 'Shown if the user inputs no message',
				),
				'error_missing_subject' => array(
					'label'         => 'Content Missing Text',
					'type'          => 'text',
					'default_value' => 'Subject missing',
					'instructions'  => 'Shown if the user inputs no subject',
				),
				'error_insert'          => array(
					'label'         => 'Insert Post failed text',
					'type'          => 'text',
					'default_value' => 'An error happened when sending your message. Please try again later.',
					'instructions'  => 'Shown if there is a wordpress error when inserting the message',
				),
				'error_send_team'       => array(
					'label'         => 'Sending team email failed.',
					'type'          => 'text',
					'default_value' => 'An error happened when sending your message to us.',
					'instructions'  => 'Shown if there is a wordpress error when sending the message to the team.',
				),
				'error_send_customer'   => array(
					'label'         => 'Send customer confirmation',
					'type'          => 'text',
					'default_value' => 'Sending the confirmation email to you failed. We still received your message but this probably means your email was wrong.',
					'instructions'  => 'Shown if there is a wordpress error when sending the mail to the customer',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => MAGIC_CONTACT_FORM_PAGE_TEMPLATE,
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'  => array(
				'position'       => 'normal',
				'layout'         => 'default',
				'hide_on_screen' => array(
					0 => 'the_content',
					1 => 'excerpt',
					2 => 'custom_fields',
					3 => 'discussion',
					4 => 'comments',
					5 => 'author',
					6 => 'featured_image',
					7 => 'categories',
					8 => 'tags',
				),
			),
		)
	);
}
