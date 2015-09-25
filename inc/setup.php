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
 * テーマのセットアップ
 * @return void
 */


function epigone_setup(){

	load_theme_textdomain( 'epigone', get_template_directory() . '/languages' );

	// automatic feed をサポート
	add_theme_support( 'automatic-feed-links' );

	// パンくず をサポート
	add_theme_support( 'epigone-breadcrumbs' );

	// ページネーション をサポート
	add_theme_support( 'epigone-pagination' );

	// アイキャッチ画像のサポート
	add_theme_support( 'post-thumbnails' );

	// メニューのサポート
	add_theme_support( 'menus' );

	// タイトルタグをサポート
	add_theme_support( 'title-tag' );

	// HTML5構造化マークアップで出力
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

	// ヘッダーナビゲーションを登録
	register_nav_menus( array( 'primary' => __( 'Header Primary Navigation', 'epigone' ) ) );

	// editor-style を登録
	add_editor_style( 'assets/css/editor-style.css' );

}

add_action( 'after_setup_theme', 'epigone_setup' );

/**
 * wp_head() で出力されるタグの調整
 *
 * @return void
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
 * アバターの取得
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
add_filter( 'get_avatar', 'epigone_get_avatar', 10, 2 );

/**
 * 検索テンプレートを変更
 *
 * @param $form string
 * @return string フォームのHTML
 */
function epinoge_search_form( $form ) {

	ob_start();
	get_template_part( 'modules/searchform' );
	$form = ob_get_clean();
	return $form;

}
add_filter( 'get_search_form', 'epinoge_search_form' );


/**
 * パンくずの読み込み
 *
 * @return void
 */
function epigone_include_breadcrumbs(){

	if ( current_theme_supports( 'epigone-breadcrumbs' ) ) {
		get_template_part( 'modules/breadcrumbs' );
	}

}

add_action( 'get_footer', 'epigone_include_breadcrumbs' );



if ( class_exists( 'TGM_Plugin_Activation' ) ) {
	add_action('tgmpa_register', 'epigone_theme_register_required_plugins');
	/**
	 * Register the required plugins for this theme.
	 *
	 * In this example, we register five plugins:
	 * - one included with the TGMPA library
	 * - two from an external source, one from an arbitrary source, one from a GitHub repository
	 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function epigone_theme_register_required_plugins()
	{
		/*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
		$plugins = array(

			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name' => 'Ultimate Post Widget', // The plugin name.
				'slug' => 'ultimate-posts-widget', // The plugin slug (typically the folder name).
				'required' => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),


			// This is an example of the use of 'is_callable' functionality. A user could - for instance -
			// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
			// 'wordpress-seo-premium'.
			// By setting 'is_callable' to either a function from that plugin or a class method
			// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
			// recognize the plugin as being installed.
			array(
				'name' => 'Black Studio TinyMCE Widget',
				'slug' => 'black-studio-tinymce-widget',
				'required' => true,
				'force_activation' => true,
			),

		);

		/*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
		$config = array(
			'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu' => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug' => 'themes.php',            // Parent menu slug.
			'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices' => true,                    // Show admin notices or not.
			'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message' => '',                      // Message to output right before the plugins table.
		);

		tgmpa($plugins, $config);
	}

}
