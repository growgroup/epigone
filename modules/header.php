<?php
/**
 * Header Modules.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */

if ( get_theme_mod('header_style', 'top') == 'top' || get_theme_mod('header_style', 'top') == 'header_none' ) {
	get_template_part( 'modules/navbar' );
}

if ( get_theme_mod('header_style', 'top') !== 'header_none' ) {

	?>

	<header id="masthead" class="header header-normal" role="banner">
		<div class="row">
			<div class="large-12 columns">
				<p class="header__description"><?php bloginfo('description') ?></p>

				<h1 class="header__logo">
					<a href="<?php echo home_url(); ?>">
						<?php
						if (get_theme_mod('logo_image', '')) {
							?>
							<img src="<?php echo get_theme_mod('logo_image', '') ?>" alt="<?php bloginfo('name'); ?>"/>
							<?php
						} else {
							bloginfo('name');
						} ?>

					</a>
				</h1>
			</div>
			<div class="large-12 columns">
				<?php

				epigone_dynamic_sidebar('header-primary');
				do_action('get_header');
				?>
			</div>
		</div>
	</header>

	<?php
}

if ( get_theme_mod('header_style', 'top') == 'bottom' ) {
	get_template_part( 'modules/navbar' );
}
?>
