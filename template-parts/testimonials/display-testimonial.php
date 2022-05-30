<?php
/**
 * The template for displaying testimonial items
 *
 * @package Chique
 */
?>

<?php
$enable = get_theme_mod( 'chique_testimonial_option', 'disabled' );

if ( ! chique_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$type = get_theme_mod( 'chique_testimonial_type', 'category' );

$tagline = get_theme_mod( 'chique_testimonial_section_tagline' );
if ( 'jetpack-testimonial' === $type ) {
	// Get Jetpack options for testimonial.
	$jetpack_defaults = array(
		'page-title' => esc_html__( 'Testimonials', 'chique-pro' ),
	);

	// Get Jetpack options for testimonial.
	$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );

	$headline    = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'chique-pro' );
	$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';
} else {
	$headline    = get_theme_mod( 'chique_testimonial_headline', esc_html__( 'Testimonials', 'chique-pro' ) );
	$subheadline = get_theme_mod( 'chique_testimonial_subheadline' );
}

$classes[] = 'section testimonial-content-section';

if ( ! $headline && ! $subheadline && ! $tagline ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php chique_section_header( $tagline, $headline, $subheadline  ); 
	 
		if ( 'post' === $type || 'jetpack-testimonial' === $type || 'page' === $type || 'category' === $type || 'tag' === $type ) {
			get_template_part( 'template-parts/testimonials/post-types-testimonial' );
		} elseif ( 'custom' === $type ) {
			get_template_part( 'template-parts/testimonials/custom-testimonial' );
		}
	?>
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
