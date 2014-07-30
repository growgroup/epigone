<?php
/**
 * search form module
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */
?>

<form role="form" action="<?php echo site_url( '/' ); ?>" id="searchform" method="get">
	<label for="s" class="sr-only"><?php _e( 'Search', 'epigone' ); ?></label>
	<div class="input-group">
		<input type="text" class="form-control" id="s" name="s" placeholder="<?php _e( 'Search', 'epigone' ); ?>" value="" />
		<span class="input-group-btn">
			<button type="submit" class="btn"><?php _e( 'Submit', 'epigone' ); ?> </button>
		</span>
	</div> <!-- .input-group -->
</form>
