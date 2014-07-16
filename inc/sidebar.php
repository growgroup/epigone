<?php
/**
 * register sidebar
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'epigone_custom_sidebar' );

function epigone_custom_sidebar() {

	register_sidebar( array(
		'name'          => __( 'Sidebar Primary', 'epigone' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget widget-sidebar %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Primary Area', 'epigone' ),
		'id'            => 'header-primary',
		'before_widget' => '<section class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Above Contents', 'epigone' ),
		'id'            => 'content-primary',
		'before_widget' => '<section class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Primary', 'epigone' ),
		'id'            => 'footer-primary',
		'before_widget' => '<section class="widget widget-footer %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );
}


