<?php
/**
 * theme script & stylesheet
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */

add_action( 'wp_enqueue_scripts', 'epigone_script', 100 );

function epigone_script() {
	/**
	 * theme main stylesheet
	 */
	wp_enqueue_style( 'epigone_main', get_template_directory_uri() . '/assets/css/main.min.css', false, '99972085bc30c435929f5af3cf81d064' );

	/**
	 * theme main javascript.
	 */
	wp_register_script( 'epigone_scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '632995d66dba190b04e58c7bbf9d6222', true );

	if ( ! is_admin() && current_theme_supports( 'jquery-cdn' ) ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false );
		add_filter( 'script_loader_src', 'epigone_jquery_local_fallback', 10, 2 );
	}

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'epigone_scripts' );
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
