/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra
 * @since x.x.x
 */

( function( $ ) {
	
	// Trigger Icon Color.
	astra_css(
		'astra-settings[mobile-header-toggle-btn-color]',
		'fill',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-toggle-icon .ast-mobile-svg',
	);

	// Trigger Label Color.
	astra_css(
		'astra-settings[mobile-header-toggle-btn-color]',
		'color',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu',
	);

	// Trigger Icon Width.
	astra_css(
		'astra-settings[mobile-header-toggle-icon-size]',
		'width',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-toggle-icon .ast-mobile-svg',
		'px'
	);

	// Trigger Icon Height.
	astra_css(
		'astra-settings[mobile-header-toggle-icon-size]',
		'height',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-toggle-icon .ast-mobile-svg',
		'px'
	);

	// Trigger Button Background Color.
	astra_css(
		'astra-settings[mobile-header-toggle-btn-bg-color]',
		'background',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .menu-toggle.ast-mobile-menu-trigger-fill',
	);

	// Border Size for Trigger Button.
	wp.customize( 'astra-settings[mobile-header-toggle-btn-border-size]', function( setting ) {
		setting.bind( function( border ) {
			var dynamicStyle = '[data-section="section-header-mobile-trigger"] .ast-button-wrap .menu-toggle.main-header-menu-toggle {';
				dynamicStyle += 'border-top-width:'  + border.top + 'px;';
				dynamicStyle += 'border-right-width:'  + border.right + 'px;';
				dynamicStyle += 'border-left-width:'   + border.left + 'px;';
				dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
				dynamicStyle += '} ';
			astra_add_dynamic_css( 'astra-settings[mobile-header-toggle-btn-border-size]', dynamicStyle );
		} );
	} );

	// Border Radius.
	astra_css(
		'astra-settings[mobile-header-toggle-border-radius]',
		'border-radius',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .menu-toggle.main-header-menu-toggle',
		'px'
	);

	// Border Color.
	astra_css(
		'astra-settings[mobile-header-toggle-border-color]',
		'border-color',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .menu-toggle.ast-mobile-menu-trigger-outline, [data-section="section-header-mobile-trigger"] .ast-button-wrap .menu-toggle.ast-mobile-menu-trigger-fill'
	);

	// Margin.
    wp.customize( 'astra-settings[section-header-mobile-trigger' + '-margin]', function( value ) {
        value.bind( function( margin ) {
            if(
                margin.desktop.bottom != '' || margin.desktop.top != '' || margin.desktop.left != '' || margin.desktop.right != '' ||
                margin.tablet.bottom != '' || margin.tablet.top != '' || margin.tablet.left != '' || margin.tablet.right != '' ||
                margin.mobile.bottom != '' || margin.mobile.top != '' || margin.mobile.left != '' || margin.mobile.right != ''
            ) {
				var selector = '[data-section="section-header-mobile-trigger"] .ast-button-wrap .menu-toggle.main-header-menu-toggle';
                var dynamicStyle = '';
                dynamicStyle += selector + ' {';
                dynamicStyle += 'margin-left: ' + margin['desktop']['left'] + margin['desktop-unit'] + ';';
                dynamicStyle += 'margin-right: ' + margin['desktop']['right'] + margin['desktop-unit'] + ';';
                dynamicStyle += 'margin-top: ' + margin['desktop']['top'] + margin['desktop-unit'] + ';';
                dynamicStyle += 'margin-bottom: ' + margin['desktop']['bottom'] + margin['desktop-unit'] + ';';
                dynamicStyle += '} ';

                dynamicStyle +=  '@media (max-width: 768px) {';
                dynamicStyle += selector + ' {';
                dynamicStyle += 'margin-left: ' + margin['tablet']['left'] + margin['tablet-unit'] + ';';
                dynamicStyle += 'margin-right: ' + margin['tablet']['right'] + margin['tablet-unit'] + ';';
                dynamicStyle += 'margin-top: ' + margin['tablet']['top'] + margin['desktop-unit'] + ';';
                dynamicStyle += 'margin-bottom: ' + margin['tablet']['bottom'] + margin['desktop-unit'] + ';';
                dynamicStyle += '} ';
                dynamicStyle += '} ';

                dynamicStyle +=  '@media (max-width: 544px) {';
                dynamicStyle += selector + ' {';
                dynamicStyle += 'margin-left: ' + margin['mobile']['left'] + margin['mobile-unit'] + ';';
                dynamicStyle += 'margin-right: ' + margin['mobile']['right'] + margin['mobile-unit'] + ';';
                dynamicStyle += 'margin-top: ' + margin['mobile']['top'] + margin['desktop-unit'] + ';';
                dynamicStyle += 'margin-bottom: ' + margin['mobile']['bottom'] + margin['desktop-unit'] + ';';
                dynamicStyle += '} ';
                dynamicStyle += '} ';
                astra_add_dynamic_css( 'header-mobile-trigger-margin', dynamicStyle );
            }
        } );
    } );

	// Trigger Typography.
	astra_generate_outside_font_family_css(
		'astra-settings[mobile-header-label-font-family]',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);
	astra_css(
		'astra-settings[mobile-header-label-font-weight]',
		'font-weight',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);
	astra_css(
		'astra-settings[mobile-header-label-text-transform]',
		'text-transform',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);
	astra_css(
		'astra-settings[mobile-header-label-font-size]',
		'font-size',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu',
		'px'
	);
	astra_css(
		'astra-settings[mobile-header-label-line-height]',
		'line-height',
		'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu'
	);

} )( jQuery );