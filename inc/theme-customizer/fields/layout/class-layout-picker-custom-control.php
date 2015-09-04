<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class to create a custom layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control {


	public function enqueue() {

		wp_enqueue_style( 'epigone-radio-image', get_template_directory_uri() . '/inc/theme-customizer/fields/layout/radio-image.css', false, null );
	}

	/**
	 * Render the content on the theme customizer page_
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul>
				<li>
					<input type="radio" id="<?php echo esc_attr( $this->id ); ?>_l-full" name="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> class="radioImageSelect" value="l-full" <?php echo checked( $this->value(), 'l-full' ); ?> >
					<label for="<?php echo esc_attr( $this->id ); ?>_l-full">
						<img src="<?php echo get_template_directory_uri() . '/inc/theme-customizer/fields/layout/img/1col.png'; ?>" alt="">
					</label>
					</input>
				</li>
				<li>
					<input type="radio" id="<?php echo esc_attr( $this->id ); ?>_l-left-sidebar" name="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> class="radioImageSelect" value="l-left-sidebar" <?php echo checked( $this->value(), 'l-left-sidebar' ); ?>>
					<label for="<?php echo esc_attr( $this->id ); ?>_l-left-sidebar">
						<img src="<?php echo get_template_directory_uri() . '/inc/theme-customizer/fields/layout/img/2cl.png'; ?>" alt="">
					</label>
					</input>
				</li>
				<li>
					<input type="radio" id="<?php echo esc_attr( $this->id ); ?>_l-right-sidebar" name="<?php echo esc_attr( $this->id ); ?>" <?php echo $this->link(); ?> class="radioImageSelect" value="l-right-sidebar" <?php echo checked( $this->value(), 'l-right-sidebar' ); ?>>
					<label for="<?php echo esc_attr( $this->id ); ?>_l-right-sidebar">
						<img src="<?php echo get_template_directory_uri() . '/inc/theme-customizer/fields/layout/img/2cr.png'; ?>" alt="">
					</label>
					</input>
				</li>

			</ul>
		</label>
	<?php
	}
}
