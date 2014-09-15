<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package epigone
 */
?>


	<footer id="colophon" class="footer" role="contentinfo">
		<div class="container">
			<div class="footer-contents">
				<?php
				dynamic_sidebar( 'footer-primary' );
				?>
			</div>
		</div>
		<div class="footer-copyright site-info">
			<div class="container text-center">
				<span class="sep"> copyright © <?php echo date( 'Y' ); ?> | <?php bloginfo( 'name' ); ?></span>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
