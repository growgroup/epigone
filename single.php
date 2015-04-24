<?php
/**
 * 投稿テンプレート
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */


while ( have_posts() ) :
	the_post();

	get_template_part( 'templates/content', 'single' );
	epigone_post_nav();

	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template();
	}

endwhile; // end of the loop.
