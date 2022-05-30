<?php
/**
 * Promotion Contact Options
 *
 * @package Chique
 */

/**
 * Add promotion contact options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chique_promo_contact_options( $wp_customize ) {
	$wp_customize->add_section( 'chique_promotion_contact', array(
			'title' => esc_html__( 'Promotion Contact', 'chique-pro' ),
			'panel' => 'chique_theme_options',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'chique_sanitize_select',
			'choices'           => chique_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'type'              => 'select',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_image',
			'sanitize_callback' => 'chique_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Background Image', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
		)
	);

	/*Overlay Option for Promotion Headline Background Image */
	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_background_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'chique_sanitize_number_range',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Background Image Overlay', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_section_tagline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Section Tagline', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Headline', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_description',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Subheadline', 'chique-pro' ),
			'active_callback'   => 'chique_is_promotion_contact_active',
			'section'           => 'chique_promotion_contact',
			'type'              => 'textarea',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_content',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Content', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'type'              => 'textarea',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_display_promotion_contact_title',
			'default'           => '1',
			'sanitize_callback' => 'chique_sanitize_checkbox',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Display title', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'custom_control'    => 'Chique_Toggle_Control',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_more_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'More Button Text', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_more_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'More Button Link', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_promo_contact_more_target',
			'sanitize_callback' => 'chique_sanitize_checkbox',
			'active_callback'   => 'chique_is_promotion_contact_active',
			'label'             => esc_html__( 'Open Button Link in New Tab', 'chique-pro' ),
			'section'           => 'chique_promotion_contact',
			'custom_control'    => 'Chique_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'chique_promo_contact_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'chique_is_promotion_contact_active' ) ) :
	/**
	* Return true if promotion contact is active
	*
	* @since 1.0
	*/
	function chique_is_promotion_contact_active( $control ) {
		$enable = $control->manager->get_setting( 'chique_promo_contact_visibility' )->value();

		return chique_check_section( $enable );
	}
endif;
