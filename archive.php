<?php
/**
 * アーカイブテンプレート
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */
if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title">
			<?php the_archive_title(); ?>
		</h1>
		<?php
		// タームの説明欄に記述がある場合、出力
		$term_description = term_description();
		if ( ! empty( $term_description ) ) :
			printf( '<div class="taxonomy-description">%s</div>', $term_description );
		endif;
		?>
	</header><!-- .page-header -->

	<?php
	/* ループをスタート */
	while ( have_posts() ) : the_post();

		get_template_part( 'templates/content', get_post_format() );

	endwhile;

	the_posts_pagination();

else :

	get_template_part( 'content', 'none' );

endif;

