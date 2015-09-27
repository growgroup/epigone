<?php
/**
 * テーマのための関数
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://scribu.net/wordpress/theme-wrappers.html
 * =====================================================
 */

load_template( dirname(__FILE__) . '/vendor/autoload.php' );

load_template( get_template_directory() . '/inc/init.php', true );
