<?php
/**
 * The template for displaying team items
 *
 * @package Chique
 */
?>

<?php
$number = get_theme_mod( 'chique_team_number', 5 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$chique_type = get_theme_mod( 'chique_team_type', 'category' );

if ( 'post' === $chique_type || 'page' === $chique_type || 'ect-team' === $chique_type  ) {
	$args['post_type'] = $chique_type;

	for ( $i = 1; $i <= $number; $i++ ) {
		$chique_post_id = '';

		if ( 'post' === $chique_type ) {
			$chique_post_id = get_theme_mod( 'chique_team_post_' . $i );
		} elseif ( 'page' === $chique_type ) {
			$chique_post_id = get_theme_mod( 'chique_team_page_' . $i );
		} elseif ( 'ect-team' === $chique_type ) {
			$chique_post_id = get_theme_mod( 'chique_team_cpt_' . $i );
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
elseif ( 'category' === $chique_type ) {
	$no_of_post = $number;

	if ( get_theme_mod( 'chique_team_select_category' ) ) {
		$args['category__in'] = (array) get_theme_mod( 'chique_team_select_category' );
	}

	$args['post_type'] = 'post';
}

if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $args );

$show_content    = get_theme_mod( 'chique_team_show', 'excerpt' );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();
		$number = get_theme_mod( 'chique_team_number_' . ( absint( $loop ->current_post ) + 1 ) );

		$show_content = get_theme_mod( 'chique_team_show', 'hide-content' );
		$show_meta    = get_theme_mod( 'chique_team_meta_show', 'show-meta' );
		$position     = get_post_meta( get_the_ID(), 'ect_team_position', true );?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'chique-hero-content' );
						} else {
							echo '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-825x825.jpg"/>';
						}
						?>
					</a>
				</div>
				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

						<?php if ( 'show-meta' === $show_meta  && 'custom' !== $chique_type && 'ect-team' !== $chique_type ) : ?>
						<div class="entry-meta">
							<?php chique_posted_on(); ?>
						</div><!-- .entry-meta -->
						<?php elseif ( 'show-meta' === $show_meta  && 'ect-team' == $chique_type ) : ?>
							<div class="entry-meta">
								<span class="job-label"><?php echo esc_html( $position ); ?></span>
							</div>
						<?php endif; ?>

					</header>

					<?php chique_team_social_links( absint( $loop ->current_post ) + 1 ); ?>

					<?php
					if ( 'excerpt' === $show_content ) {
						$excerpt = get_the_excerpt();

						echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
					} elseif ( 'full-content' === $show_content ) {
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						echo '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
					}
					?>
				</div><!-- .entry-container -->
			</div> <!-- .hentry-inner -->
		</article> <!-- .article -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
