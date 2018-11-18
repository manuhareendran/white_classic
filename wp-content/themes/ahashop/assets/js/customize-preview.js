/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

    wp.customize( 'copyright', function( value ) {
        value.bind( function( to ) {
            $( '.copyright' ).html( to );
        });
    });

    wp.customize( 'side_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.col-100' ).css( 'backgroundColor', to );
        });
    });

    wp.customize( 'side_bg_image', function( value ) {
        value.bind( function( to ) {
            $( '.col-100' ).css( 'backgroundImage', 'url(' + to + ')' );
        });
    });

} )( jQuery );
