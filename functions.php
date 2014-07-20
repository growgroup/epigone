<?php
/**
 * function for theme.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @see http://scribu.net/wordpress/theme-wrappers.html
 * =====================================================
 */


/**
 * define site stage.
 * true : browser-sync script tag embed.
 */
// define( 'EPIGONE_DEVELOPMODE', true );

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/sidebar.php';
require get_template_directory() . '/inc/comment.php';
require get_template_directory() . '/classes/class-theme-wrapper.php';
require get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
require get_template_directory() . '/classes/class-epigone-comment.php';
