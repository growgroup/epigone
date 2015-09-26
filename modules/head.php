<?php
/**
 * Site head module
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr" itemscope itemtype="http://schema.org/Article">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="<?php echo get_bloginfo( 'title' ) ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
