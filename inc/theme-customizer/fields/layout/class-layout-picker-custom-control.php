<?php
if ( ! class_exists( 'WP_Customize_Control' ) ){
	return NULL;
}

/**
 * Class to create a custom layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control
{


	public function enqueue(){

		wp_enqueue_style( 'epigone-radio-image', get_template_directory_uri() . '/inc/theme-customizer/fields/layout/radio-image.css', false, null );
		wp_enqueue_script( 'epigone-radio-image', get_template_directory_uri() . '/inc/theme-customizer/fields/layout/radio-image.js', array( 'jquery' ), null );
		wp_enqueue_script( 'epigone-radio-image-init', get_template_directory_uri() . '/inc/theme-customizer/fields/layout/radio-image.init.js', array( 'epigone-radio-image' ), null, true );

	}
	/**
	* Render the content on the theme customizer page
	*/
	public function render_content()
	{
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul>
				<li>

					<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> class="radioImageSelect" data-image="<?php echo get_template_directory_uri() . '/inc/theme-customizer/fields/layout/img/1col.png'; ?>" value="l-full" <?php echo checked( $this->value(), 'l-full' ); ?> />
				</li>
				<li>
					<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> class="radioImageSelect" data-image="<?php echo get_template_directory_uri() . '/inc/theme-customizer/fields/layout/img/2cl.png'; ?>" value="l-left-sideber" <?php echo checked( $this->value(), 'l-left-sidebar' ); ?> />
				</li>
				<li>
					<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> class="radioImageSelect" data-image="<?php echo get_template_directory_uri() . '/inc/theme-customizer/fields/layout/img/2cr.png'; ?>" value="l-right-sideber" <?php echo checked( $this->value(), 'l-right-sidebar' ); ?> />
				</li>
			</ul>
		</label>

		<?php
	}
}
