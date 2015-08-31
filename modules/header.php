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
	<div class="row">
		<div class="large-4 columns">
			<p class="header__description"><?php bloginfo( 'description' ) ?></p>
			<h1 class="header__logo">
				<a href="<?php echo home_url(); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
		</div>
		<div class="large-8 columns">
			<?php
			if ( is_dynamic_sidebar( 'header-praimry' ) ) {
				dynamic_sidebar( 'header-primary' );
			}
			do_action( 'get_header' );
			?>
		</div>
	</div>
</header>


<?php
get_template_part( 'modules/navbar' );
?>
