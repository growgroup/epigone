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

do_action( 'get_header' );

get_template_part( 'modules/navbar' );

dynamic_sidebar( 'header-primary' ); ?>

	<section class="l-two-col layout container wrapper">

		<main class="l-main layout__main" role="main">

		<?php
		// Get main template
		load_template( epigone_template_path() ); ?>

		</main>

		<aside class="l-sidebar layout__sidebar" role="aside">
			<?php
			// Get sidebar
			get_template_part( 'modules/sidebar' ); ?>

		</aside>
	</section>

<?php

do_action( 'get_footer' );

get_template_part( 'modules/footer' );
