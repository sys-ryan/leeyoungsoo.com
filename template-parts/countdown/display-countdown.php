<?php
/**
 * The template for displaying featured content
 *
 * @package Chique
 */
?>

<?php
$enable_content = get_theme_mod( 'chique_countdown_option', 'disabled' );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$tagline 		  = get_theme_mod( 'chique_countdown_section_tagline' );
$title            = get_theme_mod( 'chique_countdown_title', esc_html__( 'Countdown', 'chique-pro' ) );
$sub_title        = get_theme_mod( 'chique_countdown_sub_title' );

$classes[] = 'section';
$classes[] = 'countdown';
if ( ! $title && ! $sub_title && ! $tagline ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="countdown-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php chique_section_header( $tagline, $title, $sub_title  ); ?>	

		<div class="section-content-wrapper">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="hentry-inner">
					<div class="entry-container">
						<div class="entry-content">
							<div id="clock"></div>
						</div><!-- .entry-content -->
					</div><!-- .entry-container -->
				</div><!-- .hentry-inner -->
			</article><!-- #post-## -->
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .section -->
