<?php

/**
 * Register sidebars customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Sidebars extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'sidebars';

	protected $section_title = 'Sidebars';

	protected $section_desc = 'Adjust styles for the primary sidebar (and secondary if your theme has enabled them). By default sidebars will adopt theme colors. You can override them here.';

	protected $section_priority = 100;

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'sidebar_primary_background'     => array(
				'css'         => array(
					'.sidebar-primary',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'sidebar_primary_alpha' )
				),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'label'       => 'Primary Sidebar Background',
				'description' => 'Default color is transparent.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_primary_alpha'          => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Primary Sidebar BG Alpha',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_secondary_background'   => array(
				'css'         => array(
					'.sidebar-secondary',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'sidebar_secondary_alpha' )
				),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'label'       => 'Secondary Sidebar Background',
				'description' => 'Default color is transparent.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_secondary_alpha'        => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Secondary Sidebar BG Alpha',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'sidebar_title_color'            => array(
				'css'         => array( '.sidebar .widget-title', 'color' ),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'description' => 'Will override default widget title options in Widget Styles section.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_title_alignment'        => array(
				'css'         => array( '.sidebar .widget-title', 'text-align' ),
				'priority'    => 10,
				'type'        => 'select',
				'default'     => null,
				'choices'     => $this->alignments,
				'description' => 'Will override default widget title options in Widget Styles section.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_list_item_border_color' => array(
				'css'       => array(
					'.sidebar li',
					'border-color',
					'',
					'',
					true,
					array( 'rgba' => 'sidebar_list_item_border_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'sidebar_list_item_border_alpha' => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'sidebar_list_item_border_style' => array(
				'css'       => array( '.sidebar li', 'border-bottom-style' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->border_styles,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'sidebar_list_item_border_width' => array(
				'css'         => array( '.sidebar li', 'border-bottom-width', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 15,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_text_color'             => array(
				'css'       => array( '.sidebar', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'sidebar_link_color'             => array(
				'css'       => array( '.sidebar a', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'sidebar_link_hover_color'       => array(
				'css'       => array( '.sidebar a:hover', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
			)
		);

	}

} // end class

new GSC_Sidebars;
