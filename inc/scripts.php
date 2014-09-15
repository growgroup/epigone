<?php
/**
 * theme script & stylesheet
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */

add_action( 'wp_enqueue_scripts', 'epigone_scripts', 100 );

function epigone_scripts() {

	/**
	 * The main style sheet.
	 */
	wp_enqueue_style( 'epigone_main', get_stylesheet_directory_uri() . '/assets/css/main.min.css', false, '99972085bc30c435929f5af3cf81d064' );

	/**
	 * Blog theme style sheet.
	 */
	wp_enqueue_style( 'epigone_blog', get_stylesheet_directory_uri() . '/assets/css/theme-blog.min.css', false, '99972085bc30c435929f5af3cf81d064' );

	/**
	 * Vendor plugin javascript.
	 */
	wp_register_script( 'epigone_plugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array(), '632995d66dba190b04e58c7bbf9d6222', true );

	/**
	 * theme main javascript.
	 */
	wp_register_script( 'epigone_scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', array(), '632995d66dba190b04e58c7bbf9d6222', true );

	if ( ! is_admin() && current_theme_supports( 'jquery-cdn' ) ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false );
		add_filter( 'script_loader_src', 'epigone_jquery_local_fallback', 10, 2 );
	}


	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'epigone_plugins' );
	wp_enqueue_script( 'epigone_scripts' );

	/**
	 * Responsive Navigation plugin.
	 */
	if ( current_theme_supports( 'responsive_nav' ) ) {
		if ( wp_is_mobile() ) {
			wp_enqueue_style( 'epigone_responsive_nav_css', get_stylesheet_directory_uri() . '/assets/components/responsive-nav/responsive-nav.css', false, '99972085bc30c435929f5af3cf81d064' );
			wp_register_script( 'epigone_responsive_nav_js', get_stylesheet_directory_uri() . '/assets/components/responsive-nav/responsive-nav.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'epigone_responsive_nav_js' );
		}
	}

}

/**
 * jquery_local_fallback
 * @see http://wordpress.stackexchange.com/a/12450
 */

add_action( 'wp_head', 'epigone_jquery_local_fallback' );

function epigone_jquery_local_fallback( $src, $handle = null ) {
	static $add_jquery_fallback = false;

	if ( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/vendor/jquery-1.11.0.min.js"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if ( $handle === 'jquery' ) {
		$add_jquery_fallback = true;
	}

	return $src;
}
