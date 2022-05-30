<?php
/**
 * The template for displaying featured content
 *
 * @package Chique
 */
?>

<?php
$enable_content = get_theme_mod( 'chique_featured_video_option', 'disabled' );
$quantity = get_theme_mod( 'chique_featured_video_number', 1 );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}
	$title     = get_theme_mod( 'chique_featured_video_archive_title' );
	$sub_title = get_theme_mod( 'chique_featured_video_sub_title' );

$tagline = get_theme_mod( 'chique_featured_video_section_tagline' );
$layout = get_theme_mod( 'chique_featured_video_layout', 'layout-one' );

$classes[] = $layout;
$classes[] = 'section featured-video';
$image = get_theme_mod( 'chique_featured_video_main_image');

if ( get_theme_mod( 'chique_featured_video_text_color' ) ) {
   $classes[] = 'content-color-white';
}
if( $image ) {
	$classes[] = 'has-background-image';
}

?>

<?php if ( $image ) : ?>
<div id="featured-video-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="background-image: url( <?php echo esc_url( $image ); ?> )">

	<?php else : ?>
		<div id="featured-video-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php endif; ?>
	<div class="wrapper">
		<?php chique_section_header( $tagline, $title, $sub_title  ); ?>

		<div class="section-content-wrapper featured-video-wrapper <?php echo esc_attr( $layout ); ?>">
			<?php
				get_template_part( 'template-parts/featured-video/video', 'featured' );
			?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
