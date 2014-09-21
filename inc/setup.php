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
		add_theme_support( 'responsive-nav' );

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
document.write("<script async src='//HOST:3000/browser-sync-client.1.3.7.js'><\/script>".replace(/HOST/g, location.hostname));
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
 * Set of theme customizer.
 * @since 1.2.0
 */

add_filter( 'epigone_theme_customizer_settings', 'epigone_customizer_settings', 1 );

function epigone_customizer_settings(){
		/**
		 * 01. Header
		 */
		$settings['epigone_header'] = array(
			'title' => __( 'Header', 'epigone' ), // Panel title
			'description' => __( 'Please have a set of headers.', 'epigone' ),
			'section' => array(
				'epigone_header_style' => array(
					'title' => __( 'Header Style', 'epigone' ),
					'setting' => array(
						'header_style' => array(
							'label' => __( 'Header Style', 'epigone' ),
							'default' => 'normal',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'normal' => __( 'Normal', 'epigone' ),
								'minimal' => __( 'Minimal', 'epigone' ),
							),
						),
					),
				),
				'epigone_logo' => array(
					'title' => __( 'Logo', 'epigone' ),
					'setting' => array(
						'logo_font_size' => array(
							'label' => __( 'Font Size', 'epigone' ),
							'default' => 9,
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'1.0' => '0',
								'1.1' => '1',
								'1.2' => '2',
								'1.3' => '3',
								'1.4' => '4',
								'1.5' => '5',
								'1.6' => '6',
								'1.7' => '7',
								'1.8' => '8',
								'1.9' => '9',
								'2.0' => '10',
							),
							'output' => array(
								'.header-logo a' => 'font-size',
							),
							'output_unit' => 'em',
						),
						'logo_color' => array(
							'label' => __( 'Color', 'epigone' ),
							'default' => '#FFFFFF',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.header-logo a' => 'color',
							)
						),
					)
				),

				'epigone_header' => array(
					'title' => __( 'Background', 'epigone' ),
					'setting' => array(
						'header_background_image' => array(
							'label' => __( 'Background Image', 'epigone' ),
							'default' => 12,
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'#masthead' => 'background-image',
							)
						),
						'header_background_attachment' => array(
							'label' => __( 'Background Attachment', 'epigone' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'epigone' ),
								'initial' => __( 'Initial', 'epigone' ),
							),
							'output' => array(
								'#masthead' => 'background-attachment',
							)
						),
						'header_background_color' => array(
							'label' => __( 'Background Color', 'epigone' ),
							'default' => '#666666',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#masthead' => 'background-color',
							),
						),
					),
				),
				// navigation section
				'epigone_navigation_color' => array(
					'title' => __( 'Navigation Color ', 'epigone' ),
					'description' => __( 'Setting for Theme color.', 'epigone' ),
					'setting' => array(
						'nav_background_color' => array(
							'label' => __( 'Normal Background', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.navbar-collapse>ul>li>a'                   => 'background-color',
								'.navbar-collapse>ul>li .dropdown-menu>li>a' => 'background-color',
							),
						),
						'nav_background_hover_color' => array(
							'label' => __( 'Hover Background', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.navbar-collapse>ul>li>a:hover'                   => 'background-color',
								'.navbar-collapse>ul>li .dropdown-menu>li>a:hover'                   => 'color',
							),
						),
						'nav_background_active_color' => array(
							'label' => __( 'Active Background', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.navbar-collapse>ul>li>a:active,.navbar-collapse>ul>li.current-menu-item a'                   => 'background-color',
							),
						),
						'nav_font_size' => array(
							'label' => __( 'Navigation Font Size', 'epigone' ),
							'default' => '1.0',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'0.7' => '0.7 em',
								'0.8' => '0.8 em',
								'0.9' => '0.9 em',
								'1.0' => '1.0 em',
								'1.1' => '1.1 em',
								'1.2' => '1.2 em',
								'1.3' => '1.3 em',
								'1.4' => '1.4 em',
								'1.5' => '1.5 em',
								'1.6' => '1.6 em',
								'1.7' => '1.7 em',
								'1.8' => '1.8 em',
								'1.9' => '1.9 em',
								'2.0' => '2.1 em',
							),
							'output' => array(
								'.navbar-collapse ul li a ' => 'font-size',
								'.navbar-collapse ul li a' => 'line-height',
								'.navbar-collapse ul.dropdown-menu a' => 'font-size',
								'.navbar-collapse ul.dropdown-menu a ' => 'line-height',
							),
							'output_unit' => 'em',
						),
					),
				),
			)
		);

		/**
		 * 02. Theme Color
		 */
		$settings['epigone_theme_color'] = array(
			'title' => __( 'Theme Color', 'epigone' ), // Panel title
			'section' => array(
				// theme color section
				'epigone_theme_color' => array(
					'title' => __( 'Theme Color ', 'epigone' ),
					'description' => __( 'Setting for Theme color.', 'epigone' ),
					'setting' => array(
						'theme_color' => array(
							'label' => __( 'Theme Color', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'a'                                                                 => 'color',
								'.pagination .prev, .pagination .next,comment-title'          => 'background-color',
								'.pagination .prev, .pagination .next,.nav-links div'               => 'border-color',
								'input[type=text],input[type=search],textarea,.widget_search .input-group .form-control'               => 'border-color',
								'.widget-sidebar li:nth-child(even):hover,.widget-sidebar li:hover' => 'background-color',
								'.nav-links div:hover'                                              => 'background-color',
								'.entry-meta'                                                       => 'background-color',
								'.pagination .page-numbers.current'                                 => 'background-color',
								'.widget-title:after'                                               => 'background-color',
								'th'                                                                => 'background-color',
								'.breadcrumbs ul:before,.widget-title'                              => 'color',
								'.footer-copyright'                                                 => 'background-color',
								'.archive .hentry.post:before, .search .hentry.post:before, .home .hentry.post:before' => 'background-color',
							),
						),
					),
				),
				'epigone_button_color' => array(
					'title' => __( 'Button Color ', 'epigone' ),
					'description' => __( 'Setting for button color.', 'epigone' ),
					'setting' => array(
						'button_color' => array(
							'label' => __( 'Button Color', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.btn, #submit,input[type=submit]'          => 'background-color',
								'.btn, #submit,input[type=submit] '          => 'border-color',
							),
						),
					),
				),
			),
		);

		/**
		 * 03. body
		 */
		$settings['epigone_body'] = array(
			'title' => __( 'Body Settings', 'epigone' ), // Panel title
			'description' => __( 'Please have a set of body.', 'epigone' ),
			'section' => array(
				'epigone_body' => array(
					'title' => __( 'Body ', 'epigone' ),
					'setting' => array(
						'body_background_color' => array(
							'label' => __( 'Background Color', 'epigone' ),
							'default' => '#FFFFFF',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'body' => 'background-color',
							),
						),
						'body_background_image' => array(
							'label' => __( 'Background Image', 'epigone' ),
							'default' => 'transparent',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'body' => 'background-image',
							)
						),
						'body_background_attachment' => array(
							'label' => __( 'Background Attachment', 'epigone' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'epigone' ),
								'initial' => __( 'Initial', 'epigone' ),
							),
							'output' => array(
								'body' => 'background-attachment',
							)
						),
						'body_background_size' => array(
							'label' => __( 'Background Size', 'epigone' ),
							'default' => '100% auto',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'auto auto' => __( 'Horizontal : auto Vertical : auto', 'epigone' ),
								'100% auto' => __( 'Horizontal : 100%, Vertical : auto', 'epigone' ),
								'auto 100%' => __( 'Horizontal : auto, Vertical : 100%', 'epigone' ),
								'100% 100%' => __( 'Horizontal : 100%, Vertical : 100%', 'epigone' ),
							),
							'output' => array(
								'body' => 'background-size',
							)
						),
					)
				),
				'epigone_heading' => array(
					'title' => __( 'Headings', 'epigone' ),
					'setting' => array(
						'heading_color' => array(
							'label' => __( 'Heading Color', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.entry-title,.entry-title a,.page-header .page-title,h1,h2,h3,h4,h5,h6' => 'color',
							),
						),
						'heading_font_size' => array(
							'label' => __( 'Heading Font Size', 'epigone' ),
							'default' => '1.0',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'1.0' => '1.0 em',
								'1.1' => '1.1 em',
								'1.2' => '1.2 em',
								'1.3' => '1.3 em',
								'1.4' => '1.4 em',
								'1.5' => '1.5 em',
								'1.6' => '1.6 em',
								'1.7' => '1.7 em',
								'1.8' => '1.8 em',
								'1.9' => '1.9 em',
								'2.0' => '2.1 em',
							),
							'output' => array(
								'.entry-title,.entry-title a,.page-header .page-title,h1,h2,h3,h4,h5,h6' => 'font-size',
								'.entry-title,.entry-title a,.page-header .page-title,h1,h2,h3,h4,h5' => 'line-height',
							),
							'output_unit' => 'em',
						),
					)
				),
				'epigone_text' => array(
					'title' => __( 'Text', 'epigone' ),
					'setting' => array(
						'text_color' => array(
							'label' => __( 'Text Color', 'epigone' ),
							'default' => '#333',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'body' => 'color',
								'p'    => 'color',
							),
						),
						'text_font_size' => array(
							'label' => __( 'Base Font Size', 'epigone' ),
							'default' => 0,
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'0.8' => '0.8',
								'0.9' => '0.9',
								'1.0' => '1.0',
								'1.1' => '1.1',
								'1.2' => '1.2',
								'1.3' => '1.3',
								'1.4' => '1.4',
								'1.5' => '1.5',
								'1.6' => '1.6',
								'1.7' => '1.7',
								'1.8' => '1.8',
								'1.9' => '1.9',
								'2.0' => '2.1',
							),
							'output' => array(
								'body' => 'font-size',
								// 'ul li' => 'font-size',
							),
							'output_unit' => 'em',
						),
					),
				),
			)
		);

		/**
		 * 03. Social
		 */
		$settings['epigone_social'] = array(
			'title' => __( 'Social Settings', 'epigone' ), // Panel title
			'description' => __( 'Please have a set of social.', 'epigone' ),
			'section' => array(
				'epigone_social' => array(
					'title' => __( 'Social link', 'epigone' ),
					'description' => __( 'Please enter the link of social services.', 'epigone' ),
					'setting' => array(
						'socal_facebook' => array(
							'label' => __( 'Facebook URL', 'epigone' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'socal_twitter' => array(
							'label' => __( 'Twitter URL', 'epigone' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'socal_github' => array(
							'label' => __( 'Github URL', 'epigone' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'socal_google_plus' => array(
							'label' => __( 'Google+ URL', 'epigone' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
					),
				),
			),
		);

	return $settings;
}

