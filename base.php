<?php
/**
 * base theme template
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */

get_template_part( 'modules/head' );

get_template_part( 'modules/header' );

do_action( 'get_header' );

get_template_part( 'modules/navbar' );

dynamic_sidebar( 'header-primary' ); ?>

	<section class="l-two-col layout container wrapper">

		<main class="l-main layout__main" role="main">

		<?php
		// Action hook before loading the main template.
		do_action( 'get_main_template_before' );

		load_template( epigone_template_path() ); ?>

		<?php
		// Action hook after loading the main template
		do_action( 'get_main_template_after' ); ?>
		</main>

		<aside class="l-sidebar layout__sidebar" role="aside">
			<?php
		/**
		 * Action Hook
		 */
			do_action( 'get_sidebar_template' );

			// Get sidebar
			get_template_part( 'modules/sidebar' ); ?>

		</aside>
	</section>

<?php
/**
 * Action hook "get_footer"
 */
do_action( 'get_footer' );

get_template_part( 'modules/footer' );
