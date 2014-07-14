<?php
/**
 * Header Modules.
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */
?>
<header id="masthead" class="site-header" role="banner">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header" role="main">
				<h1>
					<a class="navbar-brand" href="<?php echo home_url(); ?>">
						<?php bloginfo('name'); ?>
					</a>
				</h1>
			</div>

			<?php
				wp_nav_menu( array(
					'menu'              => 'primary',
					'theme_location'    => 'primary',
					'depth'             => 2,
					'container'         => 'div',
					'container_class'   => 'collapse navbar-collapse',
					'container_id'      => 'header-navbar-collapse',
					'menu_class'        => 'nav navbar-nav',
					'fallback_cb'       => 'WP_Bootstrap_Nav_Walker::fallback',
					'walker'            => new WP_Bootstrap_Nav_Walker())
				);
			?>
			</div>
	</nav>
</header>
