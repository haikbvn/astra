<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'Astra_Customizer_Config_Base' ) ) {

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @since 3.0.0
	 */
	class Astra_Header_Menu_Component_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Builder Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.0.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$html_config = array();

			$component_limit = defined( 'ASTRA_EXT_VER' ) ? Astra_Builder_Helper::$component_limit : Astra_Builder_Helper::$num_of_header_menu;

			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = 'section-hb-menu-' . $index;
				$_prefix  = 'menu' . $index;

				switch ( $index ) {
					case 1:
						$edit_menu_title = __( 'Primary Menu', 'astra' );
						break;
					case 2:
						$edit_menu_title = __( 'Secondary Menu', 'astra' );
						break;
					default:
						$edit_menu_title = __( 'Menu ', 'astra' ) . $index;
						break;
				}

				$_configs = array(

					/**
					 * Option: Header Builder Tabs
					 */
					array(
						'name'        => $_section . '-ast-context-tabs',
						'section'     => $_section,
						'type'        => 'control',
						'control'     => 'ast-builder-header-control',
						'priority'    => 0,
						'description' => '',
					),

					// Section: Primary Header.
					array(
						'name'        => $_section,
						'type'        => 'section',
						'title'       => $edit_menu_title,
						'panel'       => 'panel-header-builder-group',
						'priority'    => 40,
						'clone_index' => $index,
						'clone_type'  => 'header-menu',
					),

					/**
					* Option: Theme Menu create link
					*/
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-create-menu-link]',
						'default'   => astra_get_option( 'header-' . $_prefix . '-create-menu-link' ),
						'type'      => 'control',
						'control'   => 'ast-customizer-link',
						'section'   => $_section,
						'priority'  => 30,
						'link_type' => 'section',
						'linked'    => 'menu_locations',
						'link_text' => __( 'Configure Menu from Here.', 'astra' ),
						'context'   => Astra_Builder_Helper::$general_tab,
					),

					/**
					 * Option: Menu hover style
					 */
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-menu-hover-animation]',
						'default'    => astra_get_option( 'header-' . $_prefix . '-menu-hover-animation' ),
						'type'       => 'control',
						'control'    => 'ast-selector',
						'section'    => $_section,
						'priority'   => 10,
						'title'      => __( 'Menu Hover Style', 'astra' ),
						'choices'    => array(
							''          => __( 'None', 'astra' ),
							'zoom'      => __( 'Zoom In', 'astra' ),
							'underline' => __( 'Underline', 'astra' ),
							'overline'  => __( 'Over Line', 'astra' ),
						),
						'context'    => Astra_Builder_Helper::$design_tab,
						'transport'  => 'postMessage',
						'partial'    => array(
							'selector'        => '#ast-hf-menu-' . $index,
							'render_callback' => array( Astra_Builder_Header::get_instance(), 'menu_' . $index ),
						),
						'responsive' => false,
						'renderAs'   => 'text',
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 30,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$general_tab,
					),

					/**
					 * Option: Submenu width
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-width]',
						'default'     => astra_get_option( 'header-' . $_prefix . '-submenu-width' ),
						'type'        => 'control',
						'context'     => Astra_Builder_Helper::$general_tab,
						'section'     => $_section,
						'control'     => 'ast-slider',
						'priority'    => 30.5,
						'title'       => __( 'Width', 'astra' ),
						'suffix'      => 'px',
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-width-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 30.5,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$general_tab,
					),

					/**
					 * Option: Submenu Container Animation
					 */
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-container-animation]',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-container-animation' ),
						'type'       => 'control',
						'control'    => 'ast-selector',
						'section'    => $_section,
						'priority'   => 31,
						'title'      => __( 'Container Animation', 'astra' ),
						'choices'    => array(
							''           => __( 'Default', 'astra' ),
							'slide-down' => __( 'Slide Down', 'astra' ),
							'slide-up'   => __( 'Slide Up', 'astra' ),
							'fade'       => __( 'Fade', 'astra' ),
						),
						'context'    => Astra_Builder_Helper::$general_tab,
						'transport'  => 'postMessage',
						'partial'    => array(
							'selector'        => '#ast-hf-menu-' . $index,
							'render_callback' => array( Astra_Builder_Header::get_instance(), 'menu_' . $index ),
						),
						'responsive' => false,
						'renderAs'   => 'text',
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-animation-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 31,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$general_tab,
					),

					// Option: Submenu Container Divider.
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-container-divider]',
						'section'  => $_section,
						'type'     => 'control',
						'control'  => 'ast-heading',
						'title'    => __( 'Submenu Container', 'astra' ),
						'priority' => 20,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),

					// Option: Submenu Divider Size.
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-b-size]',
						'type'        => 'control',
						'control'     => 'ast-slider',
						'default'     => astra_get_option( 'header-' . $_prefix . '-submenu-item-b-size' ),
						'section'     => $_section,
						'priority'    => 20.5,
						'transport'   => 'postMessage',
						'title'       => __( 'Divider Size', 'astra' ),
						'context'     => array(
							Astra_Builder_Helper::$design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-border]',
								'operator' => '==',
								'value'    => true,
							),
						),
						'suffix'      => 'px',
						'input_attrs' => array(
							'min'  => 1,
							'step' => 1,
							'max'  => 10,
						),
					),

					// Option: Submenu item Border Color.
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-b-color]',
						'default'           => astra_get_option( 'header-' . $_prefix . '-submenu-item-b-color' ),
						'type'              => 'control',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'transport'         => 'postMessage',
						'title'             => __( 'Divider Color', 'astra' ),
						'section'           => $_section,
						'priority'          => 21,
						'context'           => array(
							Astra_Builder_Helper::$design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-border]',
								'operator' => '==',
								'value'    => true,
							),
						),
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-b-color-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 21,
						'settings' => array(),
						'context'     => array(
							Astra_Builder_Helper::$design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-border]',
								'operator' => '==',
								'value'    => true,
							),
						),
					),

					/**
					 * Option: Submenu Top Offset
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-top-offset]',
						'default'     => astra_get_option( 'header-' . $_prefix . '-submenu-top-offset' ),
						'type'        => 'control',
						'context'     => Astra_Builder_Helper::$design_tab,
						'section'     => $_section,
						'control'     => 'ast-slider',
						'priority'    => 22,
						'title'       => __( 'Top Offset', 'astra' ),
						'suffix'      => 'px',
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-top-offset-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 22,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),

					/**
					 * Group: Submenu Container Style
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-border-group]',
						'default'   => astra_get_option( 'header-' . $_prefix . '-submenu-border-group' ),
						'type'      => 'control',
						'control'   => 'ast-settings-group',
						'title'     => __( 'Border', 'astra' ),
						'section'   => $_section,
						'transport' => 'postMessage',
						'priority'  => 23,
						'context'   => Astra_Builder_Helper::$design_tab,
					),

					// Option: Sub-Menu Border.
					array(
						'name'           => 'header-' . $_prefix . '-submenu-border',
						'default'        => astra_get_option( 'header-' . $_prefix . '-submenu-border' ),
						'parent'         => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-border-group]',
						'type'           => 'sub-control',
						'control'        => 'ast-border',
						'transport'      => 'postMessage',
						'section'        => $_section,
						'linked_choices' => true,
						'priority'       => 1,
						'title'          => __( 'Border', 'astra' ),
						'choices'        => array(
							'top'    => __( 'Top', 'astra' ),
							'right'  => __( 'Right', 'astra' ),
							'bottom' => __( 'Bottom', 'astra' ),
							'left'   => __( 'Left', 'astra' ),
						),
					),

					// Option: Submenu Container Border Color.
					array(
						'name'              => 'header-' . $_prefix . '-submenu-b-color',
						'default'           => astra_get_option( 'header-' . $_prefix . '-submenu-b-color' ),
						'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-border-group]',
						'type'              => 'sub-control',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'transport'         => 'postMessage',
						'default'           => '',
						'title'             => __( 'Border Color', 'astra' ),
						'section'           => $_section,
						'priority'          => 2,
					),

					/**
					 * Option: Submenu Button Radius
					 */
					array(
						'name'        => 'header-' . $_prefix . '-submenu-border-radius',
						'default'     => astra_get_option( 'header-' . $_prefix . '-submenu-border-radius' ),
						'type'        => 'sub-control',
						'parent'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-border-group]',
						'section'     => $_section,
						'control'     => 'ast-slider',
						'priority'    => 3,
						'title'       => __( 'Border Radius', 'astra' ),
						'suffix'      => 'px',
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
					),

					// Option: Submenu Divider Checkbox.
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item-border]',
						'default'   => astra_get_option( 'header-' . $_prefix . '-submenu-item-border' ),
						'type'      => 'control',
						'control'   => 'ast-toggle-control',
						'section'   => $_section,
						'priority'  => 35,
						'title'     => __( 'Item Divider', 'astra' ),
						'context'   => Astra_Builder_Helper::$general_tab,
						'transport' => 'postMessage',
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-item--toggle-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 35,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Stack on Mobile Checkbox.
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-menu-stack-on-mobile]',
						'default'   => astra_get_option( 'header-' . $_prefix . '-menu-stack-on-mobile' ),
						'type'      => 'control',
						'control'   => 'ast-toggle-control',
						'section'   => $_section,
						'priority'  => 41,
						'title'     => __( 'Stack on Mobile', 'astra' ),
						'context'   => Astra_Builder_Helper::$general_tab,
						'transport' => 'postMessage',
					),

					/**
					 * Option: Margin Space
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[' . $_section . '-margin]',
						'default'           => '',
						'type'              => 'control',
						'transport'         => 'postMessage',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'section'           => $_section,
						'priority'          => 220,
						'title'             => __( 'Margin', 'astra' ),
						'linked_choices'    => true,
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra' ),
							'right'  => __( 'Right', 'astra' ),
							'bottom' => __( 'Bottom', 'astra' ),
							'left'   => __( 'Left', 'astra' ),
						),
						'context'           => Astra_Builder_Helper::$design_tab,
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 80,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),

					// Option Group: Menu Color.
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'type'      => 'control',
						'control'   => 'ast-settings-group',
						'title'     => __( 'Menu Colors', 'astra' ),
						'section'   => $_section,
						'transport' => 'postMessage',
						'priority'  => 90,
						'context'   => Astra_Builder_Helper::$design_tab,
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-menu-colors-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 90,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),

					// Option: Menu Color.
					array(
						'name'       => 'header-' . $_prefix . '-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'tab'        => __( 'Normal', 'astra' ),
						'section'    => $_section,
						'title'      => __( 'Link / Text Color', 'astra' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 7,
						'context'    => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Background image, color.
					array(
						'name'       => 'header-' . $_prefix . '-bg-obj-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-bg-obj-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-background',
						'section'    => $_section,
						'transport'  => 'postMessage',
						'tab'        => __( 'Normal', 'astra' ),
						'data_attrs' => array( 'name' => 'header-' . $_prefix . '-bg-obj-responsive' ),
						'title'      => __( 'Background Color', 'astra' ),
						'priority'   => 9,
						'context'    => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Hover Color.
					array(
						'name'       => 'header-' . $_prefix . '-h-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-h-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'tab'        => __( 'Hover', 'astra' ),
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'title'      => __( 'Link Color', 'astra' ),
						'section'    => $_section,
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 19,
						'context'    => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Hover Background Color.
					array(
						'name'       => 'header-' . $_prefix . '-h-bg-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-h-bg-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'type'       => 'sub-control',
						'title'      => __( 'Background Color', 'astra' ),
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'tab'        => __( 'Hover', 'astra' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 21,
						'context'    => Astra_Builder_Helper::$general_tab,
					),

					// Option: Active Menu Color.
					array(
						'name'       => 'header-' . $_prefix . '-a-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-a-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'type'       => 'sub-control',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'tab'        => __( 'Active', 'astra' ),
						'title'      => __( 'Link Color', 'astra' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 31,
						'context'    => Astra_Builder_Helper::$general_tab,
					),

					// Option: Active Menu Background Color.
					array(
						'name'       => 'header-' . $_prefix . '-a-bg-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-a-bg-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'section'    => $_section,
						'title'      => __( 'Background Color', 'astra' ),
						'tab'        => __( 'Active', 'astra' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 33,
						'context'    => Astra_Builder_Helper::$general_tab,
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-typography-styling-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 110,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),

					// Option Group: Menu Typography.
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography]',
						'default'   => astra_get_option( 'header-' . $_prefix . '-header-menu-typography' ),
						'type'      => 'control',
						'control'   => 'ast-settings-group',
						'title'     => __( 'Menu Font', 'astra' ),
						'section'   => $_section,
						'transport' => 'postMessage',
						'priority'  => 120,
						'context'   => Astra_Builder_Helper::$design_tab,
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography-divider]',
						'type'     => 'control',
						'section'   => $_section,
						'control'  => 'ast-divider',
						'priority' => 120,
						'settings' => array(),
						'context'   => Astra_Builder_Helper::$design_tab,
					),

					// Option: Menu Font Family.
					array(
						'name'      => 'header-' . $_prefix . '-font-family',
						'default'   => astra_get_option( 'header-' . $_prefix . '-font-family' ),
						'parent'    => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography]',
						'type'      => 'sub-control',
						'section'   => $_section,
						'transport' => 'postMessage',
						'control'   => 'ast-font',
						'font_type' => 'ast-font-family',
						'title'     => __( 'Family', 'astra' ),
						'priority'  => 22,
						'connect'   => 'header-' . $_prefix . '-font-weight',
						'context'   => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Font Weight.
					array(
						'name'              => 'header-' . $_prefix . '-font-weight',
						'default'           => astra_get_option( 'header-' . $_prefix . '-font-weight' ),
						'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography]',
						'section'           => $_section,
						'type'              => 'sub-control',
						'control'           => 'ast-font',
						'transport'         => 'postMessage',
						'font_type'         => 'ast-font-weight',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
						'title'             => __( 'Weight', 'astra' ),
						'priority'          => 24,
						'connect'           => 'header-' . $_prefix . '-font-family',
						'context'           => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Text Transform.
					array(
						'name'      => 'header-' . $_prefix . '-text-transform',
						'default'   => astra_get_option( 'header-' . $_prefix . '-text-transform' ),
						'parent'    => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography]',
						'section'   => $_section,
						'type'      => 'sub-control',
						'control'   => 'ast-select',
						'transport' => 'postMessage',
						'title'     => __( 'Text Transform', 'astra' ),
						'priority'  => 25,
						'choices'   => array(
							''           => __( 'Inherit', 'astra' ),
							'none'       => __( 'None', 'astra' ),
							'capitalize' => __( 'Capitalize', 'astra' ),
							'uppercase'  => __( 'Uppercase', 'astra' ),
							'lowercase'  => __( 'Lowercase', 'astra' ),
						),
						'context'   => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Font Size.
					array(
						'name'        => 'header-' . $_prefix . '-font-size',
						'default'     => astra_get_option( 'header-' . $_prefix . '-font-size' ),
						'parent'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography]',
						'section'     => $_section,
						'type'        => 'sub-control',
						'priority'    => 23,
						'title'       => __( 'Size', 'astra' ),
						'control'     => 'ast-responsive',
						'transport'   => 'postMessage',
						'input_attrs' => array(
							'min' => 0,
						),
						'units'       => array(
							'px' => 'px',
							'em' => 'em',
						),
						'context'     => Astra_Builder_Helper::$general_tab,
					),

					// Option: Menu Line Height.
					array(
						'name'              => 'header-' . $_prefix . '-line-height',
						'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-header-menu-typography]',
						'section'           => $_section,
						'type'              => 'sub-control',
						'priority'          => 26,
						'title'             => __( 'Line Height', 'astra' ),
						'transport'         => 'postMessage',
						'default'           => '',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
						'control'           => 'ast-slider',
						'suffix'            => 'em',
						'input_attrs'       => array(
							'min'  => 1,
							'step' => 0.01,
							'max'  => 10,
						),
						'context'           => Astra_Builder_Helper::$general_tab,
					),

					// Option: Spacing Heading.
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-menu-spacing-divider]',
						'section'  => $_section,
						'type'     => 'control',
						'control'  => 'ast-divider',
						'priority' => 140,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),

					// Option - Menu Space.
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-menu-spacing]',
						'default'           => astra_get_option( 'header-' . $_prefix . '-menu-spacing' ),
						'type'              => 'control',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'transport'         => 'postMessage',
						'section'           => $_section,
						'priority'          => 150,
						'title'             => __( 'Menu Space', 'astra' ),
						'linked_choices'    => true,
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra' ),
							'right'  => __( 'Right', 'astra' ),
							'bottom' => __( 'Bottom', 'astra' ),
							'left'   => __( 'Left', 'astra' ),
						),
						'context'           => Astra_Builder_Helper::$design_tab,
					),

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-component-spacing-divider]',
						'type'     => 'control',
						'section'  => $_section,
						'control'  => 'ast-divider',
						'priority' => 150,
						'settings' => array(),
						'context'  => Astra_Builder_Helper::$design_tab,
					),
				);

				$html_config[] = Astra_Builder_Base_Configuration::prepare_visibility_tab( $_section );
				$html_config[] = $_configs;
			}

			$html_config    = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			$configurations = array_merge( $configurations, $html_config );

			return $configurations;
		}
	}

	/**
	 * Kicking this off by creating object of this class.
	 */
	new Astra_Header_Menu_Component_Configs();
}
