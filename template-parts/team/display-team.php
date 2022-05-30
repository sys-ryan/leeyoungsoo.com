<?php
/**
 * The template for displaying team content
 *
 * @package Chique
 */
?>

<?php
$enable_content = get_theme_mod( 'chique_team_option', 'disabled' );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if team content is disabled.
	return;
}

$type = get_theme_mod( 'chique_team_type', 'category' );

$tagline   = get_theme_mod( 'chique_team_section_tagline' );
$title     = get_theme_mod( 'chique_team_title', esc_html__( 'Our Team', 'chique-pro' ) );
$sub_title = get_theme_mod( 'chique_team_sub_title' );

$layout = get_theme_mod( 'chique_team_layout', 'layout-three' );
$text_align  = get_theme_mod( 'chique_team_text_align', 'text-aligned-center' );

$classes[] = 'team-section';
$classes[] = 'section';
$classes[] = $text_align;

if ( ! $title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}

$style = get_theme_mod( 'chique_team_style', 'style-1' );

if ( 'style-2' == $style ) {
	$classes['style'] = 'style-2';
	$classes['design'] = get_theme_mod( 'chique_team_design', 'boxed' );
}
?>

<div id="team-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if( 'style-2' == $style ) :
			chique_section_header( $tagline, $title, $sub_title );
		endif;?>

		<div class="team-content-wrapper section-content-wrapper <?php echo esc_attr( $layout ); ?>">

		<?php if( 'style-1' == $style ) :
			chique_section_header( $tagline, $title, $sub_title );
		endif;?>

			<?php
			if ( 'custom' === $type ) {
				get_template_part( 'template-parts/team/content', 'custom' );
			} else {
				get_template_part( 'template-parts/team/post-types-team' );
			}

			?>

			<?php
				$target = get_theme_mod( 'chique_team_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'chique_team_link', '#' );
				$text   = get_theme_mod( 'chique_team_text' );

				if ( $text ) :
			?>

			<p class="view-all-button">
				<span class="more-button">
					<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a>
				</span>
			</p>
			<?php endif; ?>

		</div><!-- .team-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #team-section -->
