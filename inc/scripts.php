<?php
/**
 * テーマで使用する js, cssの登録
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */

add_action( 'wp_enqueue_scripts', 'epigone_scripts', 100 );

function epigone_scripts() {

	/**
	 * メインとなるCSS
	 * @since 1.0.0
	 */
	wp_enqueue_style( 'epigone_main', get_stylesheet_directory_uri() . '/assets/css/main.min.css', false, null );

	/**
	 * ブログテーマのCSS
	 * @since 1.1.0
	 */
	if ( current_theme_supports( 'theme-blog' ) ) {
		wp_enqueue_style( 'epigone_blog', get_stylesheet_directory_uri() . '/assets/css/theme-blog.min.css', false, null );
	}

	/**
	 * jQueryプラグイン等のjsファイル
	 * @since 1.0.0
	 */
	wp_register_script( 'epigone_plugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array(), null, true );

	/**
	 * テーマのメインjsファイル
	 * @since 1.0.0
	 */
	wp_register_script( 'epigone_scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', array(), null, true );

	/**
	 * WordPressのjQueryを使用せず、
	 * CDNからjqueryを読み込む
	 */
	if ( ! is_admin() && current_theme_supports( 'jquery-cdn' ) ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false );
		add_filter( 'script_loader_src', 'epigone_jquery_local_fallback', 10, 2 );
	}


	/**
	 * コメント欄が有効なページでは、
	 * 返信用のjsを登録
	 */
	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery' );

	/**
	 * レスポンシブナビゲーションを登録
	 * @since 1.1.0
	 */
	if ( current_theme_supports( 'responsive-nav' ) && wp_is_mobile() ) {
		wp_enqueue_style( 'epigone_responsive_nav_css', get_stylesheet_directory_uri() . '/assets/components/responsive-nav/responsive-nav.css', false, '99972085bc30c435929f5af3cf81d064' );
		wp_register_script( 'epigone_responsive_nav_js', get_stylesheet_directory_uri() . '/assets/components/responsive-nav/responsive-nav.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'epigone_responsive_nav_js' );
	}

	wp_enqueue_script( 'epigone_plugins' );
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


/**
 * link タグに付与されるid属性を削除
 * @since 1.2.0
 */
function epigone_clean_style_tag( $input ) {

	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";

}
