<?php
/**
 * Output file theme customizer.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.2.0
 * =====================================================''
 */


/**
 * Clean up output of stylesheet <link> tags
 * @since 1.2.0
 */
function epigone_clean_style_tag( $input ) {

	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";

}

add_filter( 'style_loader_tag', 'epigone_clean_style_tag' );

/**
 * Set of theme customizer.
 * @since 1.2.0
 */

function epigone_customizer_settings(){
		/**
		 * 0. General
		 */
		$settings['epigone_general'] = array(
			'title' => __( 'General', 'epigone' ), // Panel title
			'description' => __( 'Please have a set of general setting.', 'epigone' ),
			'section' => array(
				'epigone_google_analytics' => array(
					'title' => __( 'Google Analytics - Tracking code', 'epigone' ),
					'setting' => array(
						'tracking_code' => array(
							'label' => __( 'Tracking Code', 'epigone' ),
							'default' => '',
							'type' => 'textarea',
							'sanitaize_call_back' => '',
						),
					),
				),
				'epigone_meta_description' => array(
					'title' => __( 'Meta Description', 'epigone' ),
					'setting' => array(
						'meta_description' => array(
							'label' => __( 'Meta Description', 'epigone' ),
							'default' => get_bloginfo( 'description' ),
							'type' => 'textarea',
							'sanitaize_call_back' => '',
						),
					),
				),
				'epigone_meta_keyword' => array(
					'title' => __( 'Meta Keyword', 'epigone' ),
					'setting' => array(
						'meta_keyword' => array(
							'label' => __( 'Meta Keyword', 'epigone' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
					),
				),
				'epigone_favicon' => array(
					'title' => __( 'Favicon', 'epigone' ),
					'description' => __( '16  16 px .ico file or .png', 'epigone' ),
					'setting' => array(
						'meta_favicon' => array(
							'label' => __( 'Favicon', 'epigone' ),
							'default' => '',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
						),
					),
				),
			),
		);
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
							'default' => 1.0,
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
							'default' => get_template_directory_uri() . '/assets/images/header-bg.png',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'#masthead:after' => 'background-image',
							)
						),
						'header_background_attachment' => array(
							'label' => __( 'Background Attachment', 'epigone' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'epigone' ),
								'scroll' => __( 'Scroll', 'epigone' ),
							),
							'output' => array(
								'#masthead:after' => 'background-attachment',
							)
						),
						'header_background_color' => array(
							'label' => __( 'Background Color', 'epigone' ),
							'default' => '#666666',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#masthead:after' => 'background-color',
							),
						),
						'header_background_size' => array(
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
								'#masthead:after' => 'background-size',
							)
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
								'a,#reply-title,.breadcrumbs ul:before' => 'color',
								'.comment-title,.entry-meta .byline,.posted-on' => 'background-color',
								'input[type=text],input[type=search],textarea,.widget_search .input-group .form-control' => 'border-color',
								'.widget-sidebar li:nth-child(even):hover,.widget-sidebar li:hover,.nav-links div:hover' => 'background-color',
								'.pagination .page-numbers.current,.widget-title:after,th,.footer-copyright'                                 => 'background-color',
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
								'.btn, #submit,input[type=submit],.pagination .prev,.pagination .next,.btn-more' => 'background-color',
								'.nav-links div a' => 'color',
								'.nav-links div,.nav-links div:hover,.btn, #submit,input[type=submit],.pagination .prev,.pagination .next' => 'border-color',
							),
						),
					),
				),
			),
		);

		$font_size_choices = array(
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
								'.entry-title,.entry-title a,.page-header .page-title,h1,h2,h3,h4,h5,h6,.widget-title' => 'color',
							),
						),
						'heading_1_font_size' => array(
							'label' => __( 'H1 Font Size', 'epigone' ),
							'default' => '2.0',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								'h1' => 'font-size',
								'h1' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_2_font_size' => array(
							'label' => __( 'H2 Font Size', 'epigone' ),
							'default' => '1.8',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								'h2' => 'font-size',
								'h2' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_3_font_size' => array(
							'label' => __( 'H3 Font Size', 'epigone' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								'h3' => 'font-size',
								'h3' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_4_font_size' => array(
							'label' => __( 'H4 Font Size', 'epigone' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								'h4' => 'font-size',
								'h4' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_5_font_size' => array(
							'label' => __( 'H5 Font Size', 'epigone' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								'h5' => 'font-size',
								'h5' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_6_font_size' => array(
							'label' => __( 'H6 Font Size', 'epigone' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								'h6' => 'font-size',
								'h6' => 'line-height',
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
							'default' => 1.0,
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
		 * 03. Layout
		 */

		$settings['epigone_layout'] = array(
			'title' => __( 'Layout Settings', 'epigone' ), // Panel title
			'description' => __( 'Please have a set of layout.', 'epigone' ),
			'section' => array(
				'epigone_layout_top' => array(
					'title' => __( 'Top Page', 'epigone' ),
					'description' => __( 'Please select the layout.', 'epigone' ),
					'setting' => array(
						'epigone_layout_top' => array(
							'label' => __( 'Layout of top page', 'epigone' ),
							'default' => 'l-right-sidebar',
							'type' => 'layout-picker',
							'sanitaize_call_back' => '',
						),
					)
				),
				'epigone_layout_page' => array(
					'title' => __( 'static page', 'epigone' ),
					'description' => __( 'Please select the layout.', 'epigone' ),
					'setting' => array(
						'epigone_layout_page' => array(
							'label' => __( 'Layout of static page', 'epigone' ),
							'default' => 'l-right-sidebar',
							'type' => 'layout-picker',
							'sanitaize_call_back' => '',
						),
					)
				),
				'epigone_layout_single' => array(
					'title' => __( 'single page', 'epigone' ),
					'description' => __( 'Please select the layout.', 'epigone' ),
					'setting' => array(
						'epigone_layout_single' => array(
							'label' => __( 'Layout of single page', 'epigone' ),
							'default' => 'l-right-sidebar',
							'type' => 'layout-picker',
							'sanitaize_call_back' => '',
						),
					)
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
		/**
		 * 04. Footer
		 */
		$settings['epigone_footer'] = array(
			'title' => __( 'Footer', 'epigone' ), // Panel title
			'description' => __( 'Please have a set of footer.', 'epigone' ),
			'section' => array(

				'epigone_footer' => array(
					'title' => __( 'Background', 'epigone' ),
					'setting' => array(
						'footer_background_image' => array(
							'label' => __( 'Background Image', 'epigone' ),
							'default' => get_template_directory_uri() . '/assets/images/footer-bg.png',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'#colophon' => 'background-image',
							)
						),
						'footer_background_attachment' => array(
							'label' => __( 'Background Attachment', 'epigone' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'epigone' ),
								'scroll' => __( 'Scroll', 'epigone' ),
							),
							'output' => array(
								'#colophon' => 'background-attachment',
							)
						),
						'footer_background_color' => array(
							'label' => __( 'Background Color', 'epigone' ),
							'default' => '#666666',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#colophon' => 'background-color',
							),
						),
					),
				),

				// navigation section
				'epigone_scrolltop' => array(
					'title' => __( 'Scroll Top', 'epigone' ),
					'description' => __( 'Setting for Scroll top.', 'epigone' ),
					'setting' => array(
						'scroll_display' => array(
							'label' => __( 'Display', 'epigone' ),
							'default' => 'true',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'true' => __( 'Yes', 'epigone' ),
								'false' => __( 'None', 'epigone' ),
							)
						),
						'scroll_background_color' => array(
							'label' => __( 'Page Top Background', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#scroll-top a' => 'background-color',
							),
						),
					),
				),
				// navigation section
				'epigone_copyright' => array(
					'title' => __( 'Copyright', 'epigone' ),
					'description' => __( 'Setting for Copyright.', 'epigone' ),
					'setting' => array(
						'copyright_text' => array(
							'label' => __( 'Copyright text', 'epigone' ),
							'default' =>  'copyright © ' . get_the_date( 'Y' ) . get_bloginfo( 'name' ),
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'copyright_background' => array(
							'label' => __( 'Copyright Background', 'epigone' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.footer-copyright'                   => 'background-color',
							),
						),
					),
				),
			)
		);

	return $settings;
}

add_filter( 'epigone_theme_customizer_settings', 'epigone_customizer_settings', 1 );

/**
 * Theme Scroll top
 * @since 1.2.0
 */

function epigone_scroll_top(){
	if ( 'true' === get_theme_mod( 'scroll_display', false ) ) {
		echo '<div id="scroll-top"><a href="#"><i class="fa fa-angle-up"></i></a></div>';
	}
}

add_action( 'get_footer', 'epigone_scroll_top' );

/**
 * Google Analytics - Tracking
 * @since 1.2.0
 */

function epigone_tracking_code(){
	$traking_code = get_theme_mod( 'tracking_code', false );
	if ( $traking_code ) {
		echo '<!-- Google Analytics -->
' . $traking_code .
'
';
	}
}

add_action( 'wp_footer', 'epigone_tracking_code' );

/**
 * output meta tag to wp_head
 * @since 1.2.0
 */

function epigone_meta_tag(){

	$meta_tag         = '';
	$meta_description = get_theme_mod( 'meta_description', false );
	$meta_keyword     = get_theme_mod( 'meta_keyword', false );

	if ( $meta_description ) {
		$meta_tag .= '<meta name="description" content="' . esc_html( $meta_description ) . '">' . "\n";
	}

	if ( $meta_keyword ) {
		$meta_tag .=  '<meta name="keywords" content="' . esc_html( $meta_keyword ) . '">' . "\n";
	}

	echo $meta_tag;

}

add_action( 'wp_head', 'epigone_meta_tag', 10 );

/**
 * output favicon tag to wp_head
 * @since 1.2.0
 */

function epigone_favicon(){

	$favicon_tag         = '';
	$favicon = get_theme_mod( 'meta_favicon', false );


	if ( $favicon ) {
		$favicon_tag .= '<link rel="shortcut icon" href="' . esc_url( $favicon ) . '">' . "\n";
	}

	echo $favicon_tag;

}

add_action( 'wp_head', 'epigone_favicon', 10 );

