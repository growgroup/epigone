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

		<section class="layout wrapper container">

			<main class="main layout__main">

			<?php
			// Get main template
			load_template( epigone_template_path() ); ?>

			</main>

			<aside class="sidebar layout__sidebar">
				<?php
				// Get sidebar
				get_template_part( 'modules/sidebar' ); ?>

			</aside>
		</section>

<?php

do_action( 'get_footer' );

get_template_part( 'modules/footer' );
