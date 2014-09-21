<?php
if ( ! class_exists( 'WP_Customize_Control' ) ){
	return NULL;
}

/**
 * Class to create a custom date picker
 */
class Date_Picker_Custom_Control extends WP_Customize_Control
{
	/**
	* Enqueue the styles and scripts
	*/
	public function enqueue(){
		global $wp_scripts;

		wp_enqueue_script( 'jquery-ui-datepicker' );

		// get the jquery ui object
		$queryui = $wp_scripts->query( 'jquery-ui-datepicker' );

		// load the jquery ui theme
		$url = '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery.ui.datepicker.min.css';

		wp_enqueue_style( 'jquery-ui-datepicker-original', get_template_directory_uri() . '/inc/theme-customizer/fields/date/assets/datepicker-style.css', false, null );
		wp_enqueue_style( 'jquery-ui-smoothness', $url, false, null );
	}

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content(){
		?>
		<label>
			<span class="customize-date-picker-control"><?php echo esc_html( $this->label ); ?></span>
			<input type="text" id="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" class="datepicker" />
		</label>
		<?php
		$this->scripts();
	}

	public function scripts(){
		?>
		<script type="text/javascript">
			var $ = jQuery
			(function($) {
				$( "#<?php echo esc_attr( $this->id ); ?>" ).datepicker();
			})(jQuery);
		</script>
		<?php
	}
}
