<?php
/**
 * Template Name: One Column Page
 */
/**
 * Template of the one-column page
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.2.0
 * =====================================================
 */

get_template_part( 'modules/head' );

epigone_get_header();

dynamic_sidebar( 'main-visual' );
?>

	<section class="l-one-col layout container wrapper">

		<main class="l-main main grid-lg-12" role="main">

		<?php
		dynamic_sidebar( 'content-primary' );

		// Action hook before loading the main template.
		do_action( 'get_main_template_before' );

		load_template( epigone_template_path() ); ?>

		<?php
		// Action hook after loading the main template
		do_action( 'get_main_template_after' ); ?>
		</main>

	</section>

<?php
/**
 * Action hook "get_footer"
 */
do_action( 'get_footer' );

get_template_part( 'modules/footer' );

