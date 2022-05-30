<?php
/**
 * Reset Theme Options, Footer Options, Section Sorter Options, Font Family Options
 *
 * @package Chique
 */

if ( ! class_exists( 'Chique_Customizer_Reset' ) ) {
	/**
	 * Adds Reset button to customizer
	 */
	final class Chique_Customizer_Reset {
		/**
		 * @var Chique_Customizer_Reset
		 */
		private static $instance = null;

		/**
		 * @var WP_Customize_Manager
		 */
		private $wp_customize;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'customize_controls_print_scripts' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
		}

		public function customize_controls_print_scripts() {
			$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';
			
			wp_enqueue_script( 'chique-customizer-reset', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'customizer-reset' . $min . '.js', array( 'jquery' ), '20190207' );
			
			wp_localize_script( 'chique-customizer-reset', 'chiqueCustomizerReset', array(
				'reset'          => esc_html__( 'Reset', 'chique-pro' ),
				'confirm'        => esc_html__( "Caution: Reset all settings to default. Process is irreversible.", 'chique-pro' ),
				'nonce'          => array(
					'reset' => wp_create_nonce( 'chique-customizer-reset' ),
				),
				'resetSection'   => esc_html__( 'Reset section', 'chique-pro' ),
				'confirmSection' => esc_html__( "Caution: Reset section settings to default. Process is irreversible.", 'chique-pro' ),
			) );
		}

		/**
		 * Store a reference to `WP_Customize_Manager` instance
		 *
		 * @param $wp_customize
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		public function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'chique-customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			if ( 'footer_options' === $_POST['section'] ) {
				remove_theme_mod( 'chique_footer_content' );
			}

			if ( 'fonts' === $_POST['section'] ) {
				// Reset Font Family Options
				$font_family_options = chique_font_family_options();

				foreach ( $font_family_options as $key => $value ) {
					 remove_theme_mod( $key );
				}
			}

			if ( 'sorter' === $_POST['section'] ) {
				remove_theme_mod( 'chique_sections_sort' );
			}

			if ( 'all' === $_POST['section'] ) {
				$this->reset_customizer();
			}

			wp_send_json_success();
		}

		public function reset_customizer() {
			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}

Chique_Customizer_Reset::get_instance();