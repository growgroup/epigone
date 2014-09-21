/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.header-logo a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.header-description' ).text( to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[header_background_image]', function( value ) {
		value.bind( function( to ) {
			$( '#masthead' ).css( 'background-image', 'url(' + to + ')' );
		} );
	} );
	wp.customize( 'theme_mods_epigone[header_background_color]', function( value ) {
		value.bind( function( to ) {
			$( '#masthead' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[header_background_attachment]', function( value ) {
		value.bind( function( to ) {
			$( '#masthead' ).css( 'background-attachment', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[logo_color]', function( value ) {
		value.bind( function( to ) {
			$( '.header-logo a' ).css( 'color', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[logo_font_size]', function( value ) {
		value.bind( function( to ) {
			$( '.header-logo a' ).css( 'font-size', to + 'em' );
		} );
	} );
	wp.customize( 'theme_mods_epigone[body_background_image]', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-image', 'url(' + to + ')' );
		} );
	} );

	wp.customize( 'theme_mods_epigone[body_background_color]', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[body_background_attachment]', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-attachment', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[body_background_size]', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-size', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[theme_color]', function( value ) {
		value.bind( function( to ) {
			$('body').append('<div id="style-preview"></div>');
			$( '#style-preview' ).html('');
			$( '#style-preview' ).append( '<style>.btn, .pagination .prev, .pagination .next,comment-title,pagination .prev, .pagination .next,.nav-links div,.widget-sidebar li:nth-child(even):hover,.widget-sidebar li:hover,.nav-links div:hover,.entry-meta,.pagination .page-numbers.current,.widget-title:after,th,.archive .hentry.post:before, .search .hentry.post:before, .home .hentry.post:before' + '{background-color:' + to + ';}' );
			$( '#style-preview' ).append( '<style>.entry-content a,.sidebar a,.breadcrumbs ul:before,.widget-title,.entry-header .entry-title:before' + '{color:' + to + ';}' );
			$( '.pagination .prev, .pagination .next,.nav-links div' ).css( 'border-color', to );
		} );
	} );
	wp.customize( 'theme_mods_epigone[button_color]', function( value ) {
		value.bind( function( to ) {
			$( '.btn,input[type=submit],input[type=search],button' ).css( 'background-color', to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
} )( jQuery );
