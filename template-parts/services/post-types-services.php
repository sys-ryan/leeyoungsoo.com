<?php
/**
 * The template for displaying service items
 *
 * @package Chique
 */
?>

<?php
$number = get_theme_mod( 'chique_service_number', 3 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$type = get_theme_mod( 'chique_service_type', 'category' );

if ( 'post' === $type || 'page' === $type || 'ect-service' === $type ) {
	$args['post_type'] = $type;

	for ( $i = 1; $i <= $number; $i++ ) {
		$chique_post_id = '';

		if ( 'post' === $type ) {
			$chique_post_id = get_theme_mod( 'chique_service_post_' . $i );
		} elseif ( 'page' === $type ) {
			$chique_post_id = get_theme_mod( 'chique_service_page_' . $i );
		} elseif ( 'ect-service' === $type ) {
			$chique_post_id = get_theme_mod( 'chique_service_cpt_' . $i );
		}

		if ( $chique_post_id && '' !== $chique_post_id ) {
			// Polylang Support.
			if ( class_exists( 'Polylang' ) ) {
				$chique_post_id = pll_get_post( $chique_post_id, pll_current_language() );
			}

			$post_list = array_merge( $post_list, array( $chique_post_id ) );

			$no_of_post++;
		}
	}

	$args['post__in'] = $post_list;
	$args['orderby'] = $post__in;
}
elseif ( 'category' === $type ) {
	$no_of_post = $number;

	if ( get_theme_mod( 'chique_service_select_category' ) ) {
		$args['category__in'] = (array) get_theme_mod( 'chique_service_select_category' );
	}

	$args['post_type'] = 'post';
}

if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $args );

$show_content = get_theme_mod( 'chique_service_show', 'excerpt' );
$show_meta    = get_theme_mod( 'chique_service_meta_show', 'hide-meta' );
$show_cat     = get_theme_mod( 'chique_service_category_show', 'hide-cat' );
$style        = get_theme_mod( 'chique_service_style', 'style-one' );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();
		$number = get_theme_mod( 'chique_service_number_' . ( absint( $loop ->current_post ) + 1 ) ); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<?php if ( 'style-one' === $style ) : ?>
					<?php
						$thumbnail = trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-825x825.jpg';

						if ( has_post_thumbnail() ) {
							$thumbnail = get_the_post_thumbnail_url( null, 'chique-hero-content' );
						}
						?>
						<div class="post-thumbnail" style="background-image: url( <?php echo esc_url( $thumbnail ); ?> );">
							<a class="cover-link" href="<?php the_permalink(); ?>"></a>
						</div>
				<?php else: ?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'chique-featured' );
							}
							else {
								$image = '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-666x499.jpg"/>';

								// Get the first image in page, returns false if there is no image.
								$first_image = chique_get_first_image( $post->ID, 'chique-featured', '' );

								// Set value of image as first image if there is an image present in the page.
								if ( $first_image ) {
									$image = $first_image;
								}

								echo $image;
							}
							?>
						</a>
					</div>
				<?php endif; ?>

				<div class="entry-container">
					<header class="entry-header">
						<?php if ( 'show-meta' === $show_meta  && ( 'ect-service' == $type || 'post' === $type || 'category' === $type ) ) : ?>
							<div class="entry-meta">
								<?php chique_entry_category(); ?>
							</div>
						<?php endif; ?>
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

						<?php if ( 'show-meta' === $show_meta  && 'custom' !== $type ) : ?>
						<div class="entry-meta">
							<?php chique_posted_on(); ?>
						</div><!-- .entry-meta -->
						<?php endif; ?>

					</header>

					<?php
					if ( 'excerpt' === $show_content ) {
						$excerpt = get_the_excerpt();

						echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
					} elseif ( 'full-content' === $show_content ) {
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						echo '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
					} ?>
				</div><!-- .entry-container -->
			</div> <!-- .hentry-inner -->
		</article> <!-- .article -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
