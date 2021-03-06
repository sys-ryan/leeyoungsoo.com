/* global chiqueColorMain, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var colorScheme  = chiqueColorMain.colorScheme;
	var colorOptions = chiqueColorMain.colorOptions;
	var cssTemplate = wp.template( 'chique-color-scheme' ),
		colorSchemeKeys = colorOptions,
		colorSettings   = colorOptions;

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					var colors = colorScheme[value].colors;

					var i = 0;

					jQuery.each( colorOptions, function( index, value ) {
						api( value ).set( colors[i] );
						api.control( value ).container.find( '.color-picker-hex' )
							.data( 'data-default-color', colors[i] )
							.wpColorPicker( 'defaultColor', colors[i] );
						i++;
					});
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(),
			css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});

		// Add additional color.
		// jscs:disable
		//colors.border_color = Color( colors.main_text_color ).toCSS( 'rgba', 0.2 );
		colors.button_fourteen_background_color     		= Color( colors.button_background_color ).toCSS( 'rgba', 0.14 );
		colors.button_three_background_color 				= Color( colors.button_background_color ).toCSS( 'rgba', 0.03 );
		colors.secondary_ninety_six_background_color   		= Color( colors.secondary_background_color ).toCSS( 'rgba', 0.96 );
		colors.secondary_sixty_link_color    				= Color( colors.secondary_link_color ).toCSS( 'rgba', 0.6 );
		// jscs:enable

		css = cssTemplate( colors );
		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		});
	});
} )( wp.customize );
