<?php
/**
 * The template for displaying featured content
 *
 * @package Chique
 */
?>

<?php
$enable_content = get_theme_mod( 'chique_featured_content_option', 'disabled' );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$type = get_theme_mod( 'chique_featured_content_type', 'category' );

if ( 'custom' !== $type ) {
	$featured_posts = chique_get_featured_posts();

	if ( empty( $featured_posts ) ) {
		return;
	}
}

$tagline = get_theme_mod( 'chique_featured_content_section_tagline' );
if ( 'featured-content' === $type ) {
	$title    = get_option( 'featured_content_title', esc_html__( 'Contents', 'chique-pro' ) );
	$subtitle = get_option( 'featured_content_content' );
} else {
	$title    = get_theme_mod( 'chique_featured_content_archive_title', esc_html__( 'Featured', 'chique-pro' ) );
	$subtitle = get_theme_mod( 'chique_featured_content_sub_title', esc_html__( 'My Featured Articles', 'chique-pro' ) );
}

$layout = get_theme_mod( 'chique_featured_content_layout', 'layout-three' );

$text_align  = get_theme_mod( 'chique_featured_content_text_align', 'text-aligned-center' );

$classes['defaults']   = 'featured-content-section section';
$classes['text-align'] = get_theme_mod( 'chique_featured_content_text_align', 'text-aligned-center' );
$classes['style']      = get_theme_mod( 'chique_featured_content_style', 'style-one' );
$classes['design']     = get_theme_mod( 'chique_featured_content_design', 'fluid' );

if ( ! $title && ! $subtitle ) {
	$classes['heading'] = 'no-section-heading';
}

?>

<div id="featured-content" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php chique_section_header( $tagline, $title, $subtitle  ); ?>

		<div class="section-content-wrapper <?php echo esc_attr( $layout ); ?>">

			<?php
			if ( 'custom' === $type ) {
				get_template_part( 'template-parts/featured-content/content', 'custom' );
			} else {
				get_template_part( 'template-parts/featured-content/post-types-featured-content' );
			}
			?>

			<?php
				$target = get_theme_mod( 'chique_featured_content_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'chique_featured_content_link', '#' );
				$text   = get_theme_mod( 'chique_featured_content_text' );

				if ( $text ) :
			?>

			<p class="view-all-button">
				<span class="more-button">
					<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a>
				</span>
			</p>
			<?php endif; ?>

		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
