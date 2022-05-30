/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	var style = $( '#chique-color-scheme-css' ),
		api = wp.customize;

	if ( ! style.length ) {
		style = $( 'head' ).append( '<style type="text/css" id="chique-color-scheme-css" />' )
		                    .find( '#chique-color-scheme-css' );
	}

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
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
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		} );
	} );

	// Header text color.
	api( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'color-scheme-default color-scheme-dark color-scheme-photography color-scheme-corporate color-scheme-ecommerce color-scheme-music color-scheme-wedding color-scheme-blog color-scheme-construction color-scheme-lawyer color-scheme-fitness color-scheme-yellow color-scheme-gray' );
			$( 'body' ).addClass( 'color-scheme-' + to );
		});
	});
} )( jQuery );
