( function( api ) {

	// Extends our custom "photolog-pro" section.
	api.sectionConstructor['photolog-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
