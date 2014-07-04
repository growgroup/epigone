<?php
/**
 * theme setup script
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================''
 */

add_action( 'wp_footer', 'print_browser_sync', 99 );

/**
 * Print browserSync client script tag.
 * @return [type] [description]
 */
function print_browser_sync(){

	$output = '';
	if ( defined( 'EPIGONE_DEVELOPMODE' )
			 && true === EPIGONE_DEVELOPMODE ) {

		$output = <<<EOF
<script type='text/javascript'>//<![CDATA[
document.write("<script async src='//HOST:3000/browser-sync-client.1.1.2.js'><\/script>".replace(/HOST/g, location.hostname));
//]]></script>
EOF;

		echo $output;

	}

}

