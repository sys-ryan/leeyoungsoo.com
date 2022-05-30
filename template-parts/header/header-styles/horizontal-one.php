<?php
/**
 * Header Style - Horizontal Style One
 *
 * @package Chique
 */
?>
<header id="masthead" class="site-header">
	<div class="site-header-main">
		<div class="wrapper">
			<?php get_template_part( 'template-parts/header/site-branding' ); ?>

			<?php get_template_part( 'template-parts/header/site-contact' ); ?>

		</div><!-- .wrapper -->
	</div> <!-- .site-header-main -->
	<div id="site-primary-header-menu" class="site-primary-header-menu">
		<div class="wrapper">
			<?php get_template_part( 'template-parts/header/site-navigation-horizontal' ); ?>
		</div>
	</div><!-- .below-header -->
</header><!-- #masthead -->
