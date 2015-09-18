<?php
/**
 * Register sidebar area
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */


function epigone_dynamic_sidebar( $index ){
	$detect = new Mobile_Detect();

	if ( $detect->isMobile() ){
		$id = "mobile_" . $index;
	} else {
		$id =  $index;
	}
	return dynamic_sidebar( $id );
}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'epigone_pc_sidebar' );

function epigone_pc_sidebar() {

	register_sidebar( array(
		'name'          => __( 'Sidebar Primary', 'epigone' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<div class="widget widget-sidebar %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Primary Area', 'epigone' ),
		'id'            => 'header-primary',
		'before_widget' => '<div class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Main Visual', 'epigone' ),
		'id'            => 'main-visual',
		'before_widget' => '<div class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Above Contents', 'epigone' ),
		'id'            => 'content-primary',
		'before_widget' => '<div class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Under Content', 'epigone' ),
		'id'            => 'content-secondary',
		'before_widget' => '<div class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Under title (single post)', 'epigone' ),
		'id'            => 'single-under-title',
		'before_widget' => '<div class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Primary', 'epigone' ),
		'id'            => 'footer-primary',
		'before_widget' => '<div class="widget large-3 columns widget-footer %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title footer-title">',
		'after_title'   => '</h3>',
	) );

}



add_action( 'widgets_init', 'epigone_smp_sidebar' );

function epigone_smp_sidebar() {

	$mobile_prefix = "mobile_";


	register_sidebar( array(
		'name'          => __( 'Sidebar Primary (mobile)', 'epigone' ),
		'id'            => $mobile_prefix . 'sidebar-primary',
		'before_widget' => '<div class="widget widget-sidebar %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Primary Area (mobile)', 'epigone' ),
		'id'            => $mobile_prefix . 'header-primary',
		'before_widget' => '<div class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Main Visual (mobile)', 'epigone' ),
		'id'            => $mobile_prefix . 'main-visual',
		'before_widget' => '<div class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Above Contents (mobile)', 'epigone' ),
		'id'            => $mobile_prefix .'content-primary',
		'before_widget' => '<div class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Under Content (mobile)', 'epigone' ),
		'id'            => $mobile_prefix . 'content-secondary',
		'before_widget' => '<div class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Under title (single post) (mobile)', 'epigone' ),
		'id'            => $mobile_prefix . 'single-under-title',
		'before_widget' => '<div class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Primary (mobile)', 'epigone' ),
		'id'            => $mobile_prefix . 'footer-primary',
		'before_widget' => '<div class="widget large-3 columns widget-footer %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title footer-title">',
		'after_title'   => '</h3>',
	) );

}


