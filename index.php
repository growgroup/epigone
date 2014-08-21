<?php
/**
 * The main template file.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */

if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		get_template_part( 'templates/content', get_post_format() );

	endwhile;

	epigone_paging_nav();

else :

	get_template_part( 'templates/content', 'none' );

endif;
