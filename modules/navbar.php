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

<div class="contain-to-grid">
<nav class="top-bar global-navigation" role="navigation">
	<div class="row">
		<div class="top-bar-section">
			<?php
			/**
			 * Global Navigation
			 */
			wp_nav_menu(
				array(
					'menu' => 'primary',
					'theme_location' => 'primary',
					'depth' => 2,
					'container' => 'div',
					'container_class' => 'collapse large-12 columns btn-group',
					'container_id' => 'header-navbar-collapse',
					'menu_class' => 'nav navbar-nav btn',
					'fallback_cb' => 'Epigone_Walker_Nav::fallback',
					'walker' => new Epigone_Walker_Nav(),
				)
			);
			?>
		</div>
	</div>
</nav>

</div>
