<?php
/**
 * Setup script for this theme
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================''
 */

/**
 * Setup support for theme.
 * @return void
 */

if ( ! function_exists( 'epigone_setup' ) ) {

	function epigone_setup(){

		load_theme_textdomain( 'epigone', get_template_directory() . '/languages' );

		// Supports automatic feed.
		add_theme_support( 'automatic-feed-links' );

		// Support for eye-catching image.
		add_theme_support( 'post-thumbnails' );

		// support for menus
		add_theme_support( 'menus' );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery' ) );

		// registration header navigation
		register_nav_menus( array( 'primary' => __( 'Header Primary Navigation', 'epigone' ) ) );

		// editor-style
		add_editor_style( 'assets/css/editor-style.css' );

	}

	add_action( 'after_setup_theme', 'epigone_setup' );

}

/**
 * Clean up head
 *
 */

function epigone_head_cleanup(){

	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	global $wp_widget_factory;

	remove_action( 'wp_head',
		array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style',
		)
	);
}

/**
 * wp_head にフック
 */
add_filter( 'wp_head', 'epigone_head_cleanup', 10 );

/**
 * Print browserSync client script tag.
 *
 * @return void
 */

add_action( 'wp_footer', 'epigone_print_browser_sync', 99 );

function epigone_print_browser_sync(){

	$output = '';
	if ( defined( 'BROWSERSYNC_MODE' )
			 && true === BROWSERSYNC_MODE ) {

		$output = <<<EOF
<script type='text/javascript'>//<![CDATA[
document.write("<script async src='//HOST:3000/browser-sync-client.1.3.5.js'><\/script>".replace(/HOST/g, location.hostname));
//]]></script>
EOF;
		echo $output;
	}

}

/**
 * Get an avatar
 * @param  string $avatar
 * @param  string $type
 * @return string
 */

function epigone_get_avatar( $avatar, $type ){

	if ( ! is_object( $type ) ) {
		return $avatar;
	}

	$avatar = str_replace( "class='avatar", "class='avatar left media-object", $avatar );

	return $avatar;

}
// filter hook for "get_avater"
add_filter( 'get_avatar', 'epigone_get_avatar', 10, 2 );


/**
 * Change Search form template
 */
add_filter( 'get_search_form', 'epinoge_search_form' );

function epinoge_search_form( $form ) {

	ob_start();
	get_template_part( 'modules/searchform' );
	$form = ob_get_clean();
	return $form;

}

