<?php

/**
 *  Media Uploader For Theme Customizer
 * =====================================================
 * @package    Extend Theme Customizer
 * @author     takashi ishihara
 * @license    GPLv2 or later
 * @link       https://github.com/1shiharaT/extend-theme-customizer
 * =====================================================
 */

if ( ! class_exists( 'WP_Customize_Control' ) ){
	return NULL;
}

class Slider_Custom_Control extends WP_Customize_Control
{

	/**
	 * Control Slug
	 * @var string
	 */
	public $type = 'slider';

	/**
	 * Input ID
	 * @var string
	 */
	protected $input_id = '';

	/**
	 * construct
	 */
	public function __construct( $manager, $id, $args = array() )
	{

		parent::__construct( $manager, $id, $args );

		$this->input_id = $this->type . '_control_' . $this->id;

	}

	/**
	 * js, css enqueue
	 * @return void
	 */
	public function enqueue()
	{

		wp_enqueue_media();

		// js
		$js_path = get_template_directory_uri() . '/inc/theme-customizer/fields/slider/assets/customizer-slider.js';

		wp_enqueue_script( 'jquery-ui-slider' );

		wp_enqueue_script( 'slider-control', $js_path , array( 'jquery', 'jquery-ui-slider' ) );

		// css
		$css_path = get_template_directory_uri() . '/inc/theme-customizer/fields/slider/assets/customizer-slider.css';

		wp_enqueue_style( 'slider-control', $css_path );

	}

	/**
	 * rendering theme customizer
	 */
	public function render_content()
	{
		$this->the_field();
		$this->the_scripts( $image_srcs );
	}


	/**
	 * Return Button
	 *
	 * @return void html
	 */
	public function the_field() {
	?>
		<label>
		    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
				<span></span>
				<div id="<?php echo esc_attr( $this->input_id ); ?>"class="slider"></div>
				<input type="hidden" class="slider-input <?php echo esc_attr( $this->input_id );?>" value="<?php echo esc_attr( $this->value() ); ?>" />
		</label>
	<?php
 }

	/**
	 * uploaded images
	 */
	public function the_scripts( $srcs = array() )
	{
	?>
	<script type="text/javascript">
		var $ = jQuery;
		$(function () {
			$( "#<?php echo esc_attr( $this->input_id );?>" ).slider({
				value: <?php echo  $this->value(); ?>,
				min: <?php echo $this->input_attrs['min'];?>,
				max: <?php echo $this->input_attrs['max'];?>,
				slide: function( event, ui ) {
					$( ".<?php echo esc_attr( $this->input_id );?>" ).val( ui.value );
				}
			});
		});
	</script>
	<?php
	}
}
