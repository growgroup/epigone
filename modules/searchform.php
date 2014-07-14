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
		<input type="text" class="form-control" id="s" name="s" placeholder="<?php _e( '検索する', 'epigone' ); ?>" value="" />
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary"><i class="icon-search"></i><?php _e( 'Submit', 'epigone' ); ?> </button>
		</span>
	</div> <!-- .input-group -->
</form>
