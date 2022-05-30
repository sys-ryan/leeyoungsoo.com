<?php
/**
 * The template for displaying services content
 *
 * @package Chique
 */
?>

<?php
$enable_content = get_theme_mod( 'chique_service_option', 'disabled' );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$type  = get_theme_mod( 'chique_service_type', 'category' );
$style = get_theme_mod( 'chique_service_style', 'style-one' );

$tagline = get_theme_mod( 'chique_service_section_tagline' );

if ( 'ect-service' === $type ) {
	$title     = get_option( 'ect_service_title', esc_html__( 'Services', 'chique-pro' ) );
	$sub_title = get_option( 'ect_service_content' );
} else {
	$title     = get_theme_mod( 'chique_service_archive_title', esc_html__( 'Services', 'chique-pro' ) );
	$sub_title = get_theme_mod( 'chique_service_sub_title', esc_html__( 'What We Do', 'chique-pro' ) );
}

$classes['default'] = 'services-section section';
$classes['style'] = $style;

$image = '';

if ( 'style-two' === $style ) {
	$classes['text-alignment'] = get_theme_mod( 'chique_service_style_two_text_align', 'text-aligned-left' );

	$image = get_theme_mod( 'chique_service_style_two_bg_image' );

	if ( $image ) {
		$classes['bg-image'] = 'has-background-image';
	}
}

if ( ! $title && ! $sub_title && ! $tagline ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="services-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"<?php echo $image ? ' style="background-image: url( ' . esc_url( $image ) . ' )"' : ''; ?>>
	<div class="wrapper">
		<?php chique_section_header( $tagline, $title, $sub_title  );

		$wrapper_classes[] = 'section-content-wrapper';

		$wrapper_classes['style'] = get_theme_mod( 'chique_service_layout', 'layout-one' );

		if ( 'style-two' === $style ) {
			$wrapper_classes['style'] = get_theme_mod( 'chique_service_style_two_layout', 'layout-three' );
		}
		?>

		<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>">
			<?php
			if ( 'custom' === $type ) {
				get_template_part( 'template-parts/services/content', 'custom' );
			} else {
				get_template_part( 'template-parts/services/post-types', 'services' );
			}
			?>
		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
