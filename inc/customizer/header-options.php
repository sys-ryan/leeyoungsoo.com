<?php
/**
 * Header Options add to customizer
 *
 * @package Chique
 */

/**
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chique_header_options( $wp_customize ) {
    $wp_customize->add_section( 'chique_header_options', array(
		'panel'       => 'chique_theme_options',
		'title'       => esc_html__( 'Header Options', 'chique-pro' ),
	) );

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_header_style',
			'default'           => 'vertical',
			'sanitize_callback' => 'chique_sanitize_select',
			'choices'           => array(
				'vertical'       => esc_html__( 'Vertical (Default)', 'chique-pro' ),
				'horizontal-one' => esc_html__( 'Horizontal One', 'chique-pro' ),
				'horizontal-two' => esc_html__( 'Horizontal Two(Absolute Header)', 'chique-pro' ),
			),
			'label'             => esc_html__( 'Header Style', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'radio',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_header_contact_info',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'custom_control'    => 'Chique_Note_Control',
			'label'             => esc_html__( 'Header Contact Info', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'description',
        )
    );

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_phone_label',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Phone Label', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_phone_number',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Phone', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_address_label',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Address Label', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_address',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Address', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_email_label',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Email Label', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_email_address',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Email', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_working_hours_label',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Working Hours Label', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_working_hours',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Working Hours', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_header_button_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Button Text', 'chique-pro' ),
			'section'           => 'chique_header_options',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_header_button_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Button Link', 'chique-pro' ),
			'section'           => 'chique_header_options',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_header_button_target',
			'sanitize_callback' => 'chique_sanitize_checkbox',
			'active_callback'   => 'chique_is_header_style_horizontal_one_active',
			'label'             => esc_html__( 'Open Button Link in New Window/Tab', 'chique-pro' ),
			'section'           => 'chique_header_options',
			'custom_control'    => 'Chique_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'chique_header_options', 9 );

/** Active Callback Functions **/
if ( ! function_exists( 'chique_is_header_style_horizontal_one_active' ) ) :
	/**
	* Return true if horizontal-one is active
	*
	* @since Catch Vogue Pro 1.0
	*/
	function chique_is_header_style_horizontal_one_active( $control ) {
		$style = $control->manager->get_setting( 'chique_header_style' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( 'horizontal-one' === $style );
	}
endif;
