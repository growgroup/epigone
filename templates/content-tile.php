<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry--tilecard large-3' ); ?>>

	<div class="thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<header class="hentry__header">
		<?php if ('post' == get_post_type()) : ?>
			<div class="hentry__meta">
				<?php epigone_posted_on(); ?>
			</div><!-- .hentry__meta -->
		<?php endif; ?>

		<h3 class="hentry__title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>

	</header>
	<!-- .hentry__header -->

	<?php if (is_search() || is_archive() || is_home() || is_front_page()) :  ?>
		<div class="hentry__summary">
			<?php
			the_excerpt(); ?>
		</div><!-- .hentry-summary -->
	<?php else : ?>
		<div class="hentry__content">
			<?php
			the_post_thumbnail();
			the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'epigone'));

			if (!current_theme_supports('epigone-pagination')) {
				wp_link_pages(array(
					'before' => '<div class="page-links">' . __('Pages:', 'epigone'),
					'after' => '</div>',
				));
			}
			?>
		</div><!-- .hentry-content -->
	<?php endif; ?>

	<footer class="hentry__footer">
		<?php
		if ('post' == get_post_type()) :
			$categories_list = get_the_category_list(__(', ', 'epigone'));
			if ($categories_list && epigone_categorized_blog()) :
				?>
				<span class="cat-links">
				<?php printf(__('Posted in %1$s', 'epigone'), $categories_list); ?>
				</span>
				<?php
			endif; // End if categories ?>

			<?php
		endif;

		if (!post_password_required() && (comments_open() || '0' !== get_comments_number())) : ?>
			<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'epigone'), __('1 Comment', 'epigone'), __('% Comments', 'epigone')); ?></span>        <?php
		endif; ?>

		<?php edit_post_link(__('Edit', 'epigone'), '<span class="edit-link">', '</span>'); ?>
	</footer>
	<!-- .hentry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
