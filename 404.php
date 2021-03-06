<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Chique
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="singular-content-wrap">
				<?php if ( is_active_sidebar( 'sidebar-notfound' ) ) :
						dynamic_sidebar( 'sidebar-notfound' );
					else : ?>
					<section class="error-404 not-found">
						<div class="page-content">

							<?php
							$header_image = chique_featured_overall_image();

							if ( ! $header_image ) : ?>

							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'chique-pro' ); ?></h1>
							</header><!-- .page-header -->

							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'chique-pro' ); ?></p>

							<?php endif; ?>
							<?php
								get_search_form();
							?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				<?php endif; ?>
			</div> <!-- .singular-content-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
