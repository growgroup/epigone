<?php
/**
 * Contains methods for customizing the theme customization screen.
 * @author 1shiharaT
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since 1.1.0
 */

class Epigone_Theme_Customize {

	private $slug = '';

	private $capability;

	private $theme_supports;

	private $transport;

	private $support_fields;

	/**
		* This hooks into 'customize_register' (available as of WP 3.4) and allows
		* you to add new sections and controls to the Theme Customize screen.
		*
		* Note: To enable instant preview, we have to actually write a bit of custom
		* javascript. See live_preview() for more.
		*
		* @see add_action('customize_register',$func)
		* @param \WP_Customize_Manager $wp_customize
		* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
		* @since epigone 1.1.0
		*/
	public function __construct(){

		$this->slug = get_stylesheet();

		$this->capability = 'edit_theme_options';

		$this->theme_supports = '';

		$this->transport = 'postMessage';

		$this->setting_type = 'option';


		add_action( 'init', array( $this, 'register_fields' ) );
		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'wp_head', array( $this, 'header_output' ) );
		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );

	}

	public function register_fields(){

		// Require Fields File
		$support_fields = array(
			'date' => array(
				'Date_Picker_Custom_Control' => 'date-picker',
			),
			'image' => array(
				'Multi_Image_Custom_Control' => 'multi-image',
			),
			'layout' => array(
				'Layout_Picker_Custom_Control' => 'layout-picker',
      ),
			'select' => array(
				'Category_Dropdown_Custom_Control'    => 'category-dropdown',
				'Google_Font_Dropdown_Custom_Control' => 'google-font-dropdown',
				'Menu_Dropdown_Custom_Control'        => 'menu-dropdown',
				'Post_Dropdown_Custom_Control'        => 'post-dropdown',
				'Post_Type_Dropdown_Custom_Control'   => 'post-type-dropdown',
				'Tags_Dropdown_Custom_Control'        => 'tags-dropdown',
				'Taxonomy_Dropdown_Custom_Control'    => 'taxonomy-dropdown',
				'User_Dropdown_Custom_Control'        => 'user-dropdown',
			),
			'text' => array(
				'Text_Editor_Custom_Control' => 'text-editor',
				'Textarea_Custom_Control'    => 'textarea',
			),
			'slider' => array(
				'Slider_Custom_Control' => 'slider',
			),
		);

		$this->support_fields = $support_fields;

		foreach ( $support_fields as $dir => $field_slugs ) {
			foreach ( $field_slugs as $slug ) {
				$filename = __DIR__ . '/fields/' . $dir . '/' . 'class-' . $slug . '-custom-control.php';
				if ( file_exists( $filename ) ) {
					require_once( $filename );
				} else {
					continue;
				}
			}
		}

	}

	/**
	 * Register
	 * @param  object $wp_customize
	 */

	public function register( $wp_customize ) {

		$this->wp_customize = $wp_customize;

		/**
		 * Theme Customizer Settings
		 */
		$settings['epigone_logo'] = array(
			'title' => __( 'Logo Settings', $this->slug ), // Panel title
			'description' => __( 'Please have a set of headers.', $this->slug ),
			'section' => array(
				'epigone_logo' => array(
					'title' => __( 'Logo', $this->slug ),
					'description' => __( '', $this->slug ),
					'setting' => array(
						'logo_font_size' => array(
							'label' => __( 'Font Size', $this->slug ),
							'default' => 12,
							'type' => 'slider',
							'sanitaize_call_back' => '',
							'input_attrs' =>  array(
								'min'   => 0,
								'max'   => 10,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'color: #0a0',
							),
						),
						'logo_color' => array(
							'label' => __( 'Color', $this->slug ),
							'default' => 12,
							'type' => 'color',
							'sanitaize_call_back' => '',
						)
					)
				)
			)
		);

		$settings['epigone_header'] = array(
			'title' => __( 'Header Settings', $this->slug ), // Panel title
			'description' => __( 'Please have a set of headers.', $this->slug ),
			'section' => array(
				'epigone_header' => array(
					'title' => __( 'Background', $this->slug ),
					'description' => __( '', $this->slug ),
					'setting' => array(
						'background_image' => array(
							'label' => __( 'Background Image', $this->slug ),
							'default' => 12,
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
						),
						'background_color' => array(
							'label' => __( 'Background Color', $this->slug ),
							'type' => 'color',
							'sanitaize_call_back' => '',
						)
					)
				)
			)
		);


		$this->add_customize( $settings );


		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	}
	/**
	 * customize setting init
	 * @param array $customizer_settings
	 *
	 * `` EXAMPLE SETTINGS
	 *	$customizer_settings = array(
	 * 		'panel_id' => array(
	 * 			'title' => '',
	 * 			'description' => '',
	 * 			'section' => array(
	 * 				'section_id' => array(
	 * 					'title' => '',
	 * 					'description' => '',
	 * 					'setting' => array(
	 * 						'setting_id' => array(
	 * 							'label' => '',
	 * 							'default' => '',
	 * 							'type' => '',
	 * 							'sanitaize_call_back' => '',
	 * 							'input_attrs' => array(),
	 * 						)
	 * 					)
	 * 				)
	 * 			)
	 * 		),
	 */

	public function add_customize( $customizer_settings ){

		if ( ! $this->wp_customize
				 || ( ! $customizer_settings && is_array( $customizer_settings ) ) ) {
			return false;
		}


		foreach ( $customizer_settings as $panel_id => $panel ) {

			$this->add_panel( $panel_id, $panel['title'], $panel['description'] );

			if ( is_array( $panel['section'] ) ) {

				foreach ( $panel['section'] as $section_id => $section ) {

					$section_title       = isset( $section['title'] ) ? $section['title'] : '';
					$section_description = isset( $section['description'] ) ? $section['description'] : '';
					$this->add_section( $section_id, $section_title, $section_description, $panel_id );

					if ( $section['setting'] ) {

						foreach ( $section['setting'] as $setting_id => $setting ) {

							$setting_default             = isset( $setting['default'] ) ? $setting['default'] : '';
							$setting_sanitaize_call_back = isset( $setting['sanitaize_call_back'] ) ? $setting['sanitaize_call_back'] : '';
							$setting_label               = isset( $setting['label'] ) ? $setting['label'] : '';
							$setting_type                = isset( $setting['type'] ) ? $setting['type'] : '';
							$setting_input_attrs         = isset( $setting['input_attrs'] ) ? $setting['input_attrs'] : '';

							$this->add_setting( $setting_id, $setting_default, $setting_sanitaize_call_back );
							$this->add_control( $setting_id, $setting_type, $setting_label, $section_id,  $setting_input_attrs );

						}
					}
				}
			}
		}

	}

	/**
	 * add_panel
	 * @param object $wp_customize
	 * @param string $panel_id
	 * @param string $title
	 * @param string $description
	 */
	public function add_panel( $panel_id, $title = '', $description = '' ){

		$this->wp_customize->add_panel(
			$panel_id,
			array(
				'priority'       => 10,
				'capability'     => $this->capability,
				'theme_supports' => $this->theme_supports,
				'title'          => $title,
				'description'    => $description,
			)
		);

	}

	/**
	 * add_section
	 * @param string $section_id
	 * @param string $title
	 * @param string $description
	 * @param string $panel_id
	 */
	public function add_section( $section_id, $title = '', $description = '', $panel_id = '' ){

		$section_settings = array(
			'title'          => $title,
			'priority'       => 10,
			'capability'     => $this->capability,
			'theme_supports' => $this->theme_supports,
			'description'    => $description,
		);


		if ( $panel_id ) {
			$section_settings['panel'] = $panel_id;
		}

		$this->wp_customize->add_section(
			$section_id,
			$section_settings
		);


	}

	/**
	 * add_section
	 * @param object $wp_customize
	 * @param string $setting_id
	 * @param string $title
	 * @param string $description
	 * @param string $panel_id
	 */
	public function add_setting( $setting_id, $default = '', $sanitaize_call_back = '' ){

		$setting_settings = array(
			'default'    => $default,
			'type'       => $this->setting_type,
			'capability' => $this->capability,
			'transport'  => $this->transport,
		);

		$this->wp_customize->add_setting(
			'theme_mods_' . $this->slug . '[' . $setting_id . ']',
			$setting_settings
		);

	}

	/**
	 * Add Control
	 * @param object  $wp_customize
	 * @param string  $control_id
	 * @param string  $type
	 * @param string  $label
	 * @param string  $section
	 * @param boolean $input_attrs
	 */
	public function add_control( $control_id, $type, $label, $section, $input_attrs = false ){

		$extend_field_classname = false;

		$control_settings = array(
			'type'     => $type,
			'label'    => $label,
			'section'  => $section,
			'settings' => 'theme_mods_' . $this->slug . '[' . $control_id . ']',
			'priority' => 10,
		);

		if ( $input_attrs ) {
			$control_settings['input_attrs'] = $input_attrs;
		}

		/**
		 * Check Extend Customizer field
		 */
		foreach ( $this->support_fields as $fields ) {
			foreach ( $fields as $class_name => $field ) {

				if ( $type === $field ) {
						$extend_field_classname = $class_name;
				} else {
					continue;
				}
			}
		}

		if ( $type === 'color' ) {
			$extend_field_classname = 'WP_Customize_Color_Control';
		}

		if ( $extend_field_classname ) {

			$instance = new $extend_field_classname( $this->wp_customize, $control_id, $control_settings );

			$this->wp_customize->add_control( $instance );

		} else {

			$this->wp_customize->add_control(
				$control_id,
				$control_settings
			);

		}

	}


	 /**
		* This will output the custom WordPress settings to the live theme's WP head.
		*
		* Used by hook: 'wp_head'
		*
		* @see add_action('wp_head',$func)
		* @since epigone 1.0
		*/
	 public function header_output(){
			?>
			<style type="text/css">
				<?php self::generate_css( 'a', 'color', 'header_textcolor', '#' ); ?>
				<?php self::generate_css( 'body', 'background-color', 'background_color', '#' ); ?>
				<?php self::generate_css( 'a', 'color', 'link_textcolor' ); ?>
			</style>
			<?php
	 }

	 /**
		* This outputs the javascript needed to automate the live settings preview.
		* Also keep in mind that this function isn't necessary unless your settings
		* are using 'transport'=>'postMessage' instead of the default 'transport'
		* => 'refresh'
		*
		* Used by hook: 'customize_preview_init'
		*
		* @see add_action('customize_preview_init',$func)
		* @since epigone 1.0
		*/
	public static function live_preview(){
		wp_enqueue_script(
			'epigone-themecustomizer',
			get_template_directory_uri() . '/assets/js/customizer.js',
			array(  'jquery', 'customize-preview' ),
			'',
			true
		);
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSS selector
	 * @param string $style The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool $echo Optional. Whether to print directly to the page (default: true).
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since epigone 1.0
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf(
				'%s { %s:%s; } ',
				$selector,
				$style,
				$prefix.$mod.$postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

$epigone_theme_customize = new Epigone_Theme_Customize();
