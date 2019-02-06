jQuery(function($){

	/* function to call when menu item is added to the menu */
	function add_item_callback() {
		$( '.spinner', '#buzzblogpro-widget-section' ).fadeOut(function(){
			$(this).remove();
		});
	}

	$( '#buzzblogpro-widget-menu-submit' ).click(function(){
		var selected = $('#buzzblogpro-menu-widgets :checked'),
			$button = $( this );
		if( selected.length > 0 ) {
			$( '<span class="spinner" style="visibility: visible; display: inline-block;"></span>' ).insertBefore( $button );

			/* add menu item to the menu */
			wpNavMenu.addLinkToMenu( '#' + selected.val(), selected.text(), null, add_item_callback );
		}
	});
$( '#update-nav-menu' ).on('click', '.item-edit', function(){
		$( this ).closest( '.menu-item' ).find( '.buzzblogpro_field_db-mega' ).trigger( 'change' );
	});
	$( '#update-nav-menu' )
	/* customize menu item edit screen for widget menu items */
	.on('click', '.item-edit', function(){
		var item = $(this).closest( 'li.menu-item-custom' );
		if( item.length < 1 ) return;

		if( item.find( '.buzzblogpro-widget-options' ).length > 0 ) { // widget type
			var el = item.find( '.buzzblogpro-widget-options' );
			el.prevAll().hide();

			/* for top-level menu items, show the Title field */
			if( item.hasClass( 'menu-item-depth-0' ) ) {
				item.find( '.edit-menu-item-title' ).closest( 'p' ).show();
			}

			/* init the widgets */
			if( ! el.hasClass( 'initialized' ) ) {
				$( document ).trigger( 'widget-added', [ item.find( '.buzzblogpro-widget-options' ).addClass( 'open' ) ] );
				el.addClass( 'initialized' );
			}
		}
	});

	/* show and hide Dropdown Width option based on Mega Menu selection */
	$( 'body' ).on( 'change', '.buzzblogpro_field_db-mega', function(){
		if( $( this ).val() == '' ) {
			$( this ).closest( '.menu-item' ).find( '.db-dropdown-columns-field' ).show();
		} else {
			$( this ).closest( '.menu-item' ).find( '.db-dropdown-columns-field' ).hide();
		}
	} );
	
});