jQuery( document ).ready(function( $ ) {
	
    var windowsize = $( window ).width();
	
	if ( windowsize > 800 ) {
    	$( '.entry-header' ).stick_in_parent();

		// If new posts have been added to the page
	    $( document.body ).on( 'post-load', function () {
	        $( '.entry-header' ).stick_in_parent();
	    });
    }

    // Window Resized
    $( window ).on( 'resize', function() {
		windowsize = $( window ).width();

		if ( windowsize > 800 ) {
		    $( '.entry-header' ).stick_in_parent();

			// If new posts have been added to the page
		    $( document.body ).on( 'post-load', function () {
		        $( '.entry-header' ).stick_in_parent();
		    });
	    } else {
	    	// remove sticky image
	    	$( '.entry-header' ).trigger( 'sticky_kit:detach' );
	    }
	    
	});



});