<?php
/**
 * The header for the theme
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header class="site-header">
		<div class="site-branding">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description ) {
				?>
				<p class="site-description"><?php echo esc_html( $description ); ?></p>
				<?php
			}
			?>
		</div>

		<nav class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'fallback_cb'    => 'wp_page_menu',
				'depth'          => 2,
			) );
			?>
		</nav>
	</header>

	<div class="site-content">
