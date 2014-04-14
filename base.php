<?php
/**
 * base.php
 *
 * @description  すべてを包括するテンプレート
 *
 */

get_header();

do_action('get_header'); ?>

<?php dynamic_sidebar( 'header-primary' ) ?>

<div class="wrapper container">

<?php load_template( epigone_template_path() ); ?>

</div>

<?php

do_action('get_footer');

get_footer();
