<?php
/**
 * The template used for displaying hero content
 *
 * @package Chique
 */
?>

<?php
$enable_section = get_theme_mod( 'chique_hero_content_visibility', 'homepage' );

if ( ! chique_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

$type = get_theme_mod( 'chique_hero_content_type', 'page' );

if ( 'page' === $type || 'post' === $type || 'category' === $type ) :
	get_template_part( 'template-parts/hero-content/post-type', 'hero' );
else :
	get_template_part( 'template-parts/hero-content/custom', 'hero' );
endif;
