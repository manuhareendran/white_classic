( function( $ ) {
	"use strict";

	$( document ).ready( function() {
		if ( ! $( '#loco-content .loco-paths' ).length ) {
			return;
		}

		$( '#loco-content .loco-paths tr.compact:eq(0)' ).remove();
		$( '#loco-content .loco-paths tr.compact:eq(0) td:eq(1) p:eq(0)' ).remove();
		$( '#loco-content .loco-paths input[name="select-path"][value="3"]' ).prop( 'checked', true ).trigger( 'change' );
	});
})( jQuery );
