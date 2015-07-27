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

		// Supports for Breadcrumbs.
		add_theme_support( 'epigone-breadcrumbs' );

		// Supports for pagination.
		add_theme_support( 'epigone-pagination' );

		// Support for eye-catching image.
		add_theme_support( 'post-thumbnails' );

		// support for menus
		add_theme_support( 'menus' );

		// supports for responsive navigation
//		add_theme_support( 'responsive-nav' );

		// タイトルタグをサポート
		add_theme_support( 'title-tag' );

		// Add HTML5 markup structure
		add_theme_support(
			'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form',
				'gallery',
				'caption',
			)
		);

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

add_filter( 'init', 'epigone_head_cleanup', 10 );

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
document.write("<script async src='//HOST:3000/browser-sync/browser-sync-client.1.5.2.js'><\/script>".replace(/HOST/g, location.hostname));
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

/**
 * Function to include the breadcrumb navigation
 * @return void
 * @since 1.1.0
 */
function epigone_include_breadcrumbs(){

	if ( current_theme_supports( 'epigone-breadcrumbs' ) ) {
		get_template_part( 'modules/breadcrumbs' );
	}

}

add_action( 'get_main_template_before', 'epigone_include_breadcrumbs' );

/**
 * Function to include the pagination.
 * @since 1.1.0
 * @return void
 */
function epigone_include_pagination(){

	if ( current_theme_supports( 'epigone-pagination' ) ) {
		get_template_part( 'modules/pagination' );
	}
}

add_action( 'get_main_template_after', 'epigone_include_pagination' );

/**
 *
 * @since 1.3.0
 * @return void
 */
function epigone_skrollr_init(){

	if ( current_theme_supports( 'skrollr-effect' ) ) {
		$script = '
<script type="text/javascript">
    var s = skrollr.init();
</script>
';
		echo $script;
	}
}
add_action( 'wp_footer', 'epigone_skrollr_init', 99 );

