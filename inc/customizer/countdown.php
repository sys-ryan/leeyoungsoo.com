<?php
/**
 * Countdown options
 *
 * @package Chique
 */

/**
 * Add countdown options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chique_countdown_options( $wp_customize ) {
	$wp_customize->add_section( 'chique_countdown', array(
			'title' => esc_html__( 'Countdown', 'chique-pro' ),
			'panel' => 'chique_theme_options',
		)
	);

	// Add color scheme setting and control.
	chique_register_option( $wp_customize, array(
			'name'              => 'chique_countdown_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'chique_sanitize_select',
			'choices'           => chique_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'chique-pro' ),
			'section'           => 'chique_countdown',
			'type'              => 'select',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_countdown_section_tagline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_countdown_active',
			'label'             => esc_html__( 'Section Tagline', 'chique-pro' ),
			'section'           => 'chique_countdown',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_countdown_title',
			'default'           => esc_html__( 'Countdown', 'chique-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_countdown_active',
			'label'             => esc_html__( 'Title', 'chique-pro' ),
			'section'           => 'chique_countdown',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_countdown_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_countdown_active',
			'label'             => esc_html__( 'Sub Title', 'chique-pro' ),
			'section'           => 'chique_countdown',
			'type'              => 'textarea',
		)
	);

	// Add 10 Days to current Date.
	$default    = current_time( 'Y-m-d H:i:s' );
	$default = date( 'Y-m-d H:i:s', strtotime( $default . '+ 10 days') );

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_countdown_end_date',
			'sanitize_callback' => 'chique_sanitize_date_time',
			'active_callback'   => 'chique_is_countdown_active',
			'default'           => $default,
			'label'             => esc_html__( 'End Date', 'chique-pro' ),
			'section'           => 'chique_countdown',
			'type'              => 'date_time',
		)
	);
}
add_action( 'customize_register', 'chique_countdown_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'chique_is_countdown_active' ) ) :
	/**
	* Return true if countdown is active
	*
	* @since Chique Pro 1.0
	*/
	function chique_is_countdown_active( $control ) {
		$enable = $control->manager->get_setting( 'chique_countdown_option' )->value();

		return ( chique_check_section( $enable ) );
	}
endif;
