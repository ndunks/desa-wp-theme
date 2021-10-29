/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
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
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	// Desa customizer
	function replaceStyle(id, val){
        var style = '<style id="' + id + '">' + val + '</style>';
        var el =  $( '#' + id );
        if ( el.length ) {
            el.replaceWith( style );
        } else {
            $( 'head' ).append( style );
        }
    }
    Object.keys(desa_customizable_color).forEach(
        function(id){
            var opt = desa_customizable_color[id];
            wp.customize( id, function( value ) {
                value.bind( function( to ) {
                    replaceStyle(id, opt.css.replace(/%s/g, to));
                } );
            } );
        }
    );
}( jQuery ) );
