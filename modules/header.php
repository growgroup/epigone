<?php
/**
 * Header Modules.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */
?>

	<header id="masthead" class="header header-normal" role="banner">
		<p class="header-description text-center"><?php bloginfo( 'description' ) ?></p>
		<h1 class="header-logo">
			<a href="<?php echo home_url(); ?>">
				<?php bloginfo( 'name' ); ?>

			</a>
		</h1>

<?php
		if ( is_dynamic_sidebar( 'header-primary' ) ) { ?>
		<div class="container">
			<?php
			dynamic_sidebar( 'header-primary' ); ?>

		</div>
		<?php
		}
		do_action( 'get_header' );
		get_template_part( 'modules/navbar' ); ?>
	</header>



