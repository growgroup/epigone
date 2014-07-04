<?php
/**
 * The main template file.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */
?>


<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
			get_template_part( 'content', get_post_format() );
		?>
	<?php endwhile; ?>

	<?php epigone_paging_nav(); ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>


