<?php

// http://scribu.net/wordpress/theme-wrappers.html

function Epigone_template_path() {
	return Epigone_Wrapping::$main_template;
}

function Epigone_template_base() {
	return Epigone_Wrapping::$base;
}

class Epigone_Wrapping {

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

		if ( 'index' == self::$base )
			self::$base = false;

		$templates = array( 'base.php' );

		if ( self::$base )
			array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );
		return locate_template( $templates );
	}
}

add_filter( 'template_include', array( 'Epigone_Wrapping', 'wrap' ), 99 );
