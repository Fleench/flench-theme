<?php
/**
 * The main template file
 */

get_header();
?>

	<!-- LEFT SIDEBAR: COMMENTS -->
	<aside class="sidebar-left">
		<?php
		if ( is_singular() && comments_open() ) {
			?>
			<h3><?php _e( 'Discussion', 'void-theme' ); ?></h3>
			<?php comments_template(); ?>
			<?php
		}
		?>
	</aside>

	<!-- MAIN CONTENT -->
	<main class="main-content">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="post-header">
						<h2 class="post-title">
							<?php
							if ( is_singular() ) {
								the_title();
							} else {
								?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php
							}
							?>
						</h2>

						<div class="post-meta">
							<?php
							echo get_the_date();
							echo ' • ';
							echo get_the_author();
							?>
						</div>
					</header>

					<div class="post-content">
						<?php
						if ( is_singular() ) {
							the_content();
						} else {
							the_excerpt();
							?>
							<p><a href="<?php the_permalink(); ?>">Read more →</a></p>
							<?php
						}
						?>
					</div>

					<?php
					if ( is_singular() ) {
						?>
						<footer class="post-footer">
							<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								echo 'Filed under: ';
								echo implode( ', ', array_map( function( $cat ) {
									return '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
								}, $categories ) );
							}
							?>
						</footer>
						<?php
					}
					?>
				</article>

				<?php
			}
		} else {
			?>
			<p><?php _e( 'Nothing found here.', 'void-theme' ); ?></p>
			<?php
		}
		?>
	</main>

	<!-- RIGHT SIDEBAR: AUTHOR & RELATED POSTS -->
	<aside class="sidebar-right">
		<?php
		// Author Info Section
		if ( is_singular( 'post' ) ) {
			?>
			<div class="sidebar-right-section author-info">
				<h3><?php _e( 'About the Author', 'void-theme' ); ?></h3>
				
				<?php
				$author_id = get_the_author_meta( 'ID' );
				$author_avatar = get_avatar( $author_id, 100 );
				$author_name = get_the_author_meta( 'display_name', $author_id );
				$author_bio = get_the_author_meta( 'description', $author_id );
				$author_url = get_the_author_meta( 'user_url', $author_id );
				
				echo $author_avatar;
				
				echo '<div class="author-name">' . esc_html( $author_name ) . '</div>';
				
				if ( $author_bio ) {
					echo '<div class="author-bio">' . wpautop( $author_bio ) . '</div>';
				}
				
				if ( $author_url ) {
					echo '<div class="author-links">';
					echo '<a href="' . esc_url( $author_url ) . '" target="_blank">' . __( 'Website', 'void-theme' ) . '</a>';
					echo '</div>';
				}
				?>
			</div>

			<?php
			// Related Posts Section
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$cat_ids = array_map( function( $cat ) {
					return $cat->term_id;
				}, $categories );

				$related_posts = new WP_Query( array(
					'category__in'     => $cat_ids,
					'posts_per_page'   => 5,
					'post__not_in'     => array( get_the_ID() ),
					'orderby'          => 'date',
					'order'            => 'DESC',
				) );

				if ( $related_posts->have_posts() ) {
					?>
					<div class="sidebar-right-section">
						<h3><?php _e( 'Related Posts', 'void-theme' ); ?></h3>
						<ul class="related-posts">
							<?php
							while ( $related_posts->have_posts() ) {
								$related_posts->the_post();
								?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<span class="related-post-date"><?php echo get_the_date(); ?></span>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
					wp_reset_postdata();
				}
			}
		} else {
			// On non-singular pages, show latest posts
			?>
			<div class="sidebar-right-section">
				<h3><?php _e( 'Latest Posts', 'void-theme' ); ?></h3>
				<ul class="related-posts">
					<?php
					$latest_posts = new WP_Query( array(
						'posts_per_page' => 5,
						'orderby'        => 'date',
						'order'          => 'DESC',
					) );

					while ( $latest_posts->have_posts() ) {
						$latest_posts->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<span class="related-post-date"><?php echo get_the_date(); ?></span>
						</li>
						<?php
					}
					wp_reset_postdata();
					?>
				</ul>
			</div>
			<?php
		}
		?>
	</aside>

<?php
get_footer();
