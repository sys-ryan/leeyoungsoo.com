<?php
/**
 * The template used for displaying Promotion Contact
 *
 * @package Chique
 */

$enable_section     = get_theme_mod( 'chique_promo_contact_visibility', 'disabled' );
$background_image   = get_theme_mod( 'chique_promo_contact_image' );
$chique_title       = get_theme_mod( 'chique_promo_contact_title' );
$chique_description = get_theme_mod( 'chique_promo_contact_description' );
$display_title      = get_theme_mod( 'chique_display_promotion_contact_title', 1 );
$content            = get_theme_mod( 'chique_promo_contact_content' );
$tagline 			= get_theme_mod( 'chique_promo_contact_section_tagline' );

$classes[] =  'section';
$classes[] = 'promotion-contact';

if ( ! chique_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}
?>

<div id="promotion-contact" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="section-content-wrapper">
			<article class="hentry">
				<div class="hentry-inner">

					<?php if( $background_image  ) : ?>
						<div class="post-thumbnail-background" style="background-image: url('<?php echo esc_url( $background_image ); ?>')">
						</div>
					<?php endif; ?>

					<div class="entry-container">
						<div class="content-wrap">
							<div class="heading-wrap">

								<?php if ( $tagline ) : ?>
									<div class="section-tagline">
										<?php echo esc_html( $tagline ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $display_title && $chique_title  ) : ?>
									<header class="entry-header section-title-wrapper">
										 <h2 class="entry-title">
										 	<?php echo esc_html( $chique_title ); ?>
										 </h2>
									</header><!-- .entry-header -->
								<?php endif; ?>

								<?php if ( $chique_description ) : ?>
									<div class="section-description">
										<p>
											<?php
												echo wp_kses_post( $chique_description );
											?>
										</p>
									</div><!-- .section-description-wrapper -->
								<?php endif; ?>
							</div>

							<div class="entry-content">
								<p>
									<?php echo wp_kses_post( $content ); ?>
								</p>
							</div>
						</div>


						<?php
						$more_text   = get_theme_mod( 'chique_promo_contact_more_text' );
						$more_link   = get_theme_mod( 'chique_promo_contact_more_link', '#' );
						$more_target = get_theme_mod( 'chique_promo_contact_more_target' ) ? '_blank' : '_self' ;


						if ( $more_text ) : ?>
							<div class="button-wrap">
								<p class="more-button">
									<a class="button" href="<?php echo esc_url( $more_link ); ?>" target="<?php echo esc_attr( $more_target ); ?>"><?php echo esc_html( $more_text ); ?></a>
								</p>
							</div>
						<?php
						endif;
						?>
					</div><!-- .entry-container -->
				</div><!-- .hentry-inner -->
			</article><!-- #post-## -->
		</div>
	</div><!-- .wrapper -->
</div><!-- .section -->
