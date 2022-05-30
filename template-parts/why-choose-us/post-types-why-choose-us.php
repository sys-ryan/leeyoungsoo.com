<?php
/**
 * The template for displaying why_choose_us items
 *
 * @package Chique
 */
?>

<?php
$number = get_theme_mod( 'chique_why_choose_us_number', 3 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$type = get_theme_mod( 'chique_why_choose_us_type', 'category' );

if ( 'post' === $type || 'page' === $type  ) {
	$args['post_type'] = $type;

	for ( $i = 1; $i <= $number; $i++ ) {
		$chique_post_id = '';

		if ( 'post' === $type ) {
			$chique_post_id = get_theme_mod( 'chique_why_choose_us_post_' . $i );
		} elseif ( 'page' === $type ) {
			$chique_post_id = get_theme_mod( 'chique_why_choose_us_page_' . $i );
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

	if ( get_theme_mod( 'chique_why_choose_us_select_category' ) ) {
		$args['category__in'] = (array) get_theme_mod( 'chique_why_choose_us_select_category' );
	}

	$args['post_type'] = 'post';
}

if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $args );

$show_content    = get_theme_mod( 'chique_why_choose_us_show', 'excerpt' );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		$show_content = get_theme_mod( 'chique_why_choose_us_show', 'excerpt' );
		$type         = get_theme_mod( 'chique_why_choose_us_type', 'category' );
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'chique-why-choose-us' ); ?></a>
				</div>
				<?php endif; ?>

				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
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
