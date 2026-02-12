<?php
/**
 * Theme functions and definitions
 */

/**
 * Set up theme defaults and register support for various WordPress features
 */
function void_theme_setup() {
	// Add theme support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
	) );

	// Register nav menu
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'void-theme' ),
	) );

	// Load text domain
	load_theme_textdomain( 'void-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'void_theme_setup' );

/**
 * Enqueue styles and scripts
 */
function void_theme_scripts() {
	// Enqueue stylesheet
	wp_enqueue_style( 'void-theme-style', get_stylesheet_uri() );

	// Enqueue comment reply script if needed
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'void_theme_scripts' );

/**
 * Custom excerpt length
 */
function void_theme_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'void_theme_excerpt_length' );

/**
 * Custom excerpt more text
 */
function void_theme_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'void_theme_excerpt_more' );

/**
 * Add custom image sizes
 */
add_image_size( 'void-featured', 600, 400, true );

/**
 * Remove emoji styles (optional, for that retro feel)
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
