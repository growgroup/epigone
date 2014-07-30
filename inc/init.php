<?php
/**
 * theme init script
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================''
 */

$include_files = array(
	array( 'inc/setup.php' ),
	array( 'inc/template-tags.php' ),
	array( 'inc/extras.php' ),
	array( 'inc/customizer.php' ),
	array( 'inc/jetpack.php' ),
	array( 'inc/scripts.php' ),
	array( 'inc/sidebar.php' ),
	array( 'inc/comment.php' ),
	array( 'classes/class-theme-wrapper.php' ),
	array( 'classes/class-wp-bootstrap-navwalker.php' ),
	array( 'classes/class-extend-walker-comment.php' ),
	array( 'classes/class-helper-post-type.php' ),
);

$include_files = apply_filters( 'epigone_init_files', $include_files );

foreach ( $include_files as $key => $files ) {
	if ( $filename = locate_template( $files, false ) ) {
		load_template( $filename , true );
	}
}

