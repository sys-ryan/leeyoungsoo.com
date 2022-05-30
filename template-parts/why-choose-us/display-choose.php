<?php
/**
 * The template for displaying why choose us content
 *
 * @package Chique
 */

$enable = get_theme_mod( 'chique_why_choose_us_option', 'disabled' );

if ( ! chique_check_section( $enable ) ) {
	// Bail if why choose us content is disabled.
	return;
}

$type = get_theme_mod( 'chique_why_choose_us_type', 'category' );

$section_tagline = get_theme_mod( 'chique_why_choose_us_section_tagline' );
$title           = get_theme_mod( 'chique_why_choose_us_title', esc_html__( 'Why Choose Us', 'chique-pro' ) );
$sub_title       = get_theme_mod( 'chique_why_choose_us_sub_title' );

$classes = array();

if( ! $title && ! $sub_title && ! $section_tagline ) {
	$classes[] = 'no-section-heading';
}

$main_image = '';

$style = get_theme_mod( 'chique_why_choose_us_style', 'modern');
if ( 'modern' == $style ) {
	$classes[] ='modern-style';

	if ( $main_image = get_theme_mod( 'chique_why_choose_us_main_image' ) ) {
		$classes[] = 'has-main-image';
	}
} else {
	$classes[] = 'classic-style';

	$classes[] = get_theme_mod( 'chique_why_choose_us_content_align', 'content-aligned-center' );

	$classic_layout = get_theme_mod( 'chique_why_choose_us_layout', 'layout-three' );

	if ( get_theme_mod( 'chique_why_choose_us_enable_border' ) ) {
		$classes[] = 'enabled-border';
	}
}
?>

<div class="why-choose-us-section section <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php chique_section_header( $section_tagline, $title, $sub_title  ); ?>

		<?php if ( 'modern' == $style && $main_image ) : ?>
		<div class="image-content-wrapper">
			<div class="wrapper">
				<div class="main-image" style="background-image: url( <?php echo $main_image; ?> );">
				</div><!-- .main-image -->
		<?php endif; ?>

			<?php if( 'classic' == $style ) : ?>
				<div class="section-content-wrapper <?php echo esc_attr( $classic_layout ); ?>">
			<?php else : ?>
				<div class="section-content-wrapper">
			<?php endif; ?>

			<?php
			if ( 'custom' === $type ) {
				get_template_part( 'template-parts/why-choose-us/content', 'custom' );
			} else {
				get_template_part( 'template-parts/why-choose-us/post-types', 'why-choose-us' );
			}
			?>

			<?php
				$target = get_theme_mod( 'chique_why_choose_us_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'chique_why_choose_us_link', '#' );
				$text   = get_theme_mod( 'chique_why_choose_us_text' );

				if ( $text ) :
			?>
			<p class="view-all-button">
				<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a></span>
			</p>
			<?php endif; ?>
			</div><!-- .section-content-wrapper -->
	<?php if ( 'modern' == $style && $main_image ) : ?>
		</div> <!-- .wrapper -->
		</div><!-- .image-content-wrapper -->
	<?php endif; ?>
	</div><!-- .wrapper -->
</div><!-- #why-choose-us-section -->
