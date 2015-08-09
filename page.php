<?php
/**
 * 固定ページテンプレート
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */

while ( have_posts() ) :
	the_post();

	get_template_part( 'templates/content', 'page' );

	if ( comments_open() || '0' != get_comments_number() ) :
		comments_template();
	endif;

endwhile; // end of the loop.


