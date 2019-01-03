<?php

/**
 * Register navigation customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Nav extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'menu_styles';

	protected $section_title = 'Menus Styles';

	protected $section_desc = 'Styles for menus and menu items.';

	protected $section_priority = 4;

	protected $mod_panel = 'nav_menus';

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'header_nav_item_padding'     => array(
				'css'         => array(
					'.site-header .genesis-nav-menu a',
					'padding-left padding-right',
					'',
					'px',
					true,
					array( 'media_query' => 'min-width: ' . $this->desktop_min_size . 'px' )
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 50,
				),
				'description' => 'Modifies horizontal padding. Header nav item height matches the logo height setting.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'nav_item_horizontal_padding' => array(
				'css'         => array(
					'.genesis-nav-menu a',
					'padding-left padding-right',
					'',
					'px',
					true,
					array( 'media_query' => 'min-width: ' . $this->desktop_min_size . 'px' )
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 50,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'nav_item_vertical_padding'   => array(
				'css'         => array(
					'.genesis-nav-menu a',
					'padding-top padding-bottom',
					'',
					'px',
					true,
					array( 'media_query' => 'min-width: ' . $this->desktop_min_size . 'px' )
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 50,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'nav_item_line_height'   => array(
				'css'         => array(
					'.genesis-nav-menu a',
					'line-height',
					'',
					'px',
					true,
					array( 'media_query' => 'min-width: ' . $this->desktop_min_size . 'px' )
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 50,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'nav_item_font'               => array(
				'css'       => array( '.genesis-nav-menu a', 'font-family' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->fonts,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'nav_item_font_weight'        => array(
				'css'         => array( '.genesis-nav-menu a', 'font-weight', '', '' ),
				'priority'    => 10,
				'type'        => 'range',
				'description' => 'From 100 (lightest) to 900 (boldest). Not all fonts support all weights.',
				'default'     => null,
				'input_attrs' => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'nav_item_text_style'         => array(
				'css'       => array( '.genesis-nav-menu a', 'text-transform' ),
				'priority'  => 10,
				'type'      => 'select',
				'choices'   => $this->caps_options,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'nav_primary_alignment'       => array(
				'css'       => array( '.menu-primary', 'text-align' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->alignments,
				'label'     => 'Primary Navigation Alignment',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'nav_secondary_alignment'     => array(
				'css'       => array( '.menu-secondary', 'text-align' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->alignments,
				'label'     => 'Secondary Navigation Alignment',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'remove_nav_item_space'       => array(
				'css'         => array(
					'.genesis-nav-menu .menu-item',
					'margin-left',
					'',
					'',
					true,
					array( 'checkbox' => true, 'value' => '-4px' )
				),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'description' => 'Removes the small space between nav items that becomes visable when background colors applied.',
				'option'      => $this->use_option,
			),
			'override_nav_colors'         => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Override Theme Menu Colors',
				'description' => 'By default your header navigation will adopt the theme colors. Check to override them and options will appear below.',
				'option'      => true, // will always be stored as an option
			),
			'header_nav_item_bg_color'    => array(
				'css'             => array(
					'.site-header .genesis-nav-menu a',
					'background-color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_nav_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Header Nav Item Background',
				'option'          => $this->use_option,
				'active_callback' => 'override_nav_colors',
				'transport'       => 'postMessage',
			),
			'header_nav_item_color'       => array(
				'css'             => array(
					'.site-header .genesis-nav-menu a',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_nav_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_nav_colors',
			),
			'header_nav_item_hover_color' => array(
				'css'             => array(
					'.site-header .genesis-nav-menu a:hover, .site-header .genesis-nav-menu .current-menu-item > a',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_nav_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'description'     => 'Also affects the active menu item.',
				'option'          => $this->use_option,
				'active_callback' => 'override_nav_colors',
			),
			'header_nav_item_hover_bg'    => array(
				'css'             => array(
					'.site-header .genesis-nav-menu a:hover,  .site-header .genesis-nav-menu .current-menu-item > a',
					'background-color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_nav_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Header Nav Item Hover Background',
				'description'     => 'Also affects the active menu item.',
				'option'          => $this->use_option,
				'active_callback' => 'override_nav_colors',
			),
			'primary_nav_bg_color'        => array(
				'css'             => array(
					'.nav-primary',
					'background-color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_nav_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Primary Navigation Background',
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_nav_colors',
			),
			'secondary_nav_bg_color'      => array(
				'css'             => array(
					'.nav-secondary',
					'background-color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_nav_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Secondary Navigation Background',
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_nav_colors',
			),
		);

	}

} // end class

new GSC_Nav;
