<?php
/**
 * sidebar settiong
 * @package epigone
 *
 */
function epigone_custom_sidebar() {

  register_sidebar(array(
    'name'          => __('サイドバー', 'epigone'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('コンテンツ上部', 'epigone'),
    'id'            => 'content-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('フッター', 'epigone'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'epigone_custom_sidebar' );
