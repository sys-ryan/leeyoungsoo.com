<?php
/**
 * Primary Menu Template
 *
 * @package Chique
 */

$menu_label = get_theme_mod( 'chique_primary_menu_label', esc_html__( 'Menu', 'chique-pro' ) );
?>
<div id="site-header-menu" class="site-header-menu">
	<div id="primary-menu-wrapper" class="menu-wrapper">

		<div class="header-overlay"></div>

		<div class="menu-cart-wrap">
			<div class="menu-toggle-wrapper">
				<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
					<div class="menu-bars">
						<div class="bars bar1"></div>
		  				<div class="bars bar2"></div>
		  				<div class="bars bar3"></div>
	  				</div>
					<span class="menu-label"><?php echo esc_html( $menu_label ); ?></span>
				</button>
			</div><!-- .menu-toggle-wrapper -->

			<?php
				if ( function_exists( 'chique_header_cart' ) ) {
					chique_header_cart();
				}
			?>
		</div> <!-- .menu-cart-wrap -->


		<div class="menu-inside-wrapper">

			<span class="menu-close fa fa-close"></span>

			<?php get_template_part( 'template-parts/header/header', 'navigation' ); ?>

			<div class="mobile-social-search">
				<?php if ( get_theme_mod( 'chique_display_primary_search', 1 ) ) : ?>
				<div class="search-container">
					<?php get_search_form(); ?>
				</div>
				<?php endif; ?>


			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'chique-pro' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'container'       => 'div',
						'container_class' => 'menu-social-container',
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'depth'          => 1,
					) );
				?>
			</nav><!-- .social-navigation -->


			</div><!-- .mobile-social-search -->
			<?php get_template_part( 'template-parts/header/site-contact' ); ?>
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->

</div><!-- .site-header-menu --> <?php

$header_style = get_theme_mod( 'chique_header_style', 'vertical' );

if( 'horizontal-two' == $header_style ) : ?>
    <div class="primary-right">
<?php endif;

if ( function_exists( 'chique_header_cart' ) ) {
	chique_header_cart();
}
?>
<div class="search-social-container">
	<?php get_template_part( 'template-parts/header/social', 'header' ); ?>

	<?php if ( get_theme_mod( 'chique_display_primary_search', 1 ) ) : ?>
	<div id="primary-search-wrapper" class="menu-wrapper">
		<div class="menu-toggle-wrapper">
			<button id="search-toggle" class="menu-toggle search-toggle">
				<span class="menu-label screen-reader-text"><?php echo esc_html_e( 'Search', 'chique-pro' ); ?></span>
			</button>
		</div><!-- .menu-toggle-wrapper -->
		<div class="menu-inside-wrapper">
			<div class="search-container">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div><!-- #primary-search-wrapper -->
	<?php endif; ?>

</div> <!-- .search-social-container -->

<?php if( 'horizontal-two' == $header_style ) : ?>
    </div>
<?php endif; ?>
