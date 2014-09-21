<?php
/**
 * Navbar module
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */
?>

		<nav class="navbar navbar-default" role="navigation">
			<div class="container">

				<?php
				/**
				 * Global Navigation
				 */
					wp_nav_menu(
						array(
							'menu'              => 'primary',
							'theme_location'    => 'primary',
							'depth'             => 2,
							'container'         => 'div',
							'container_class'   => 'collapse cf navbar-collapse',
							'container_id'      => 'header-navbar-collapse',
							'menu_class'        => 'nav navbar-nav',
							'fallback_cb'       => 'Epigone_Walker_Nav::fallback',
							'walker'            => new Epigone_Walker_Nav(),
						)
					);
				?>

			</div>
		</nav>
