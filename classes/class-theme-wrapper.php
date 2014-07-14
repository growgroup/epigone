<?php
/**
 * Theme wrapper class.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @see http://scribu.net/wordpress/theme-wrappers.html
 * =====================================================
 */


add_filter( 'template_include', array( 'Theme_Wrapper', 'wrap' ), 10, 1 );


/**
 * epigone_template_path
 *
 * @return template path
 * @since 0.0.1
 */
function epigone_template_path() {
	return Theme_Wrapper::$main_template;
}

/**
 * epigone_template_base
 *
 * @return template path
 * @since 0.0.1
 */

function epigone_template_base() {
	return Theme_Wrapper::$base;
}

/**
 * class Theme_Wrapper
 *
 */

class Theme_Wrapper {
	/**
	 * Stores the full path to the main template file
	 */
	static $main_template;


	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 */
	static $base;

	static function wrap( $template ) {
		self::$main_template = $template;

		self::$base = substr( basename( self::$main_template ), 0, -4 );

		if ( 'index' == self::$base ){
			self::$base = false;
		}

		$templates = array( 'base.php' );

		if ( self::$base ){

			array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );

			return locate_template( $templates );

		} else {

			return locate_template( $templates );

		}
	}
}

