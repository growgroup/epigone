<?php
/**
 * 検索結果用テンプレート
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */

if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'epigone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<?php /* Start the Loop */
	while ( have_posts() ) :

		the_post();
		get_template_part( 'templates/content', 'search' );

	endwhile;

	epigone_paging_nav();

else :

	get_template_part( 'content', 'none' );

endif;
