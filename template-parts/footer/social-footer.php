<?php if ( has_nav_menu( 'social-footer' ) ) : ?>
	<div class="site-social">
		<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'chique-pro' ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'social-footer',
				'container'       => 'div',
				'container_class' => 'menu-social-container',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>'
			) );
		?>
		</nav><!-- .social-navigation -->
	</div> <!-- site-social -->
<?php endif; ?>
