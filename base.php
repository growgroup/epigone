<?php
/**
 * base theme template
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */

get_template_part( 'modules/head' );
get_template_part( 'modules/header' );

do_action( 'get_header' ); ?>

<?php
dynamic_sidebar( 'header-primary' ); ?>

<div class="wrapper container">

<?php
load_template( epigone_template_path() ); ?>

</div>

<?php

do_action( 'get_footer' );

get_template_part( 'modules/footer' );
