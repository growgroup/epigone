<?php
/**
 * register sidebar
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */

function epigone_custom_sidebar() {

	register_sidebar( array(
		'name'          => __( 'Sidebar Primary', 'epigone' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget widget-sidebar %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title secondary-border">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Primary Area', 'epigone' ),
		'id'            => 'header-primary',
		'before_widget' => '<section class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title secondary-border">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Above Contents', 'epigone' ),
		'id'            => 'content-primary',
		'before_widget' => '<section class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title secondary-border">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Primary', 'epigone' ),
		'id'            => 'footer-primary',
		'before_widget' => '<section class="widget widget-footer %1$s %2$s col-xs-24 col-lg-6 col-md-6">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title secondary-border">',
		'after_title'   => '</h3>',
	) );
}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'epigone_custom_sidebar' );
