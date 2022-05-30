<?php
/**
 * The template for displaying featured content
 *
 * @package Chique
 */
?>

<?php
$enable_content = get_theme_mod( 'chique_venue_option', 'disabled' );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$type      = get_theme_mod( 'chique_venue_type', 'category' );
$tagline   = get_theme_mod( 'chique_venue_section_tagline' );
$title     = get_theme_mod( 'chique_venue_title', esc_html__( 'Wedding Details', 'chique-pro' ) );
$sub_title = get_theme_mod( 'chique_venue_sub_title' );
$layout    = get_theme_mod( 'chique_venue_layout', 'layout-three' );

$classes[] = esc_attr( $layout );
$classes[] = esc_attr( $type );
$classes[] = 'section venue';
?>

<div id="venue-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php chique_section_header( $tagline, $title, $sub_title  ); ?>

		<div class="section-content-wrapper venue-content-wrapper <?php echo esc_attr( $layout ); ?>">

			<?php
				if ( 'custom' === $type ) {
					get_template_part( 'template-parts/venue/venue', 'custom' );
				} else {
					get_template_part( 'template-parts/venue/post-types', 'venue' );
				}
			?>


			<?php
				$target = get_theme_mod( 'chique_venue_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'chique_venue_link', '#' );
				$text   = get_theme_mod( 'chique_venue_text', esc_html__( 'See Map Direction', 'chique-pro' ) );

				if ( $text ) :
			?>
			<p class="view-all-button">
				<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a></span>
			</p>
			<?php endif; ?>


		</div><!-- .section-content-wrap -->


	</div><!-- .wrapper -->
</div><!-- #venue-section -->
