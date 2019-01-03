<?php

/**
 * Register breadcrumb customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Breadcrumbs extends GSC_Base {

	protected $mod_section = 'genesis_breadcrumbs';

	protected $new_section = false;

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'breadcrumb_padding'          => array(
				'css'         => array( '.breadcrumb', 'padding', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 80,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'breadcrumb_background_color' => array(
				'css'       => array(
					'.breadcrumb',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'breadcrumb_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'breadcrumb_alpha'            => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Breadcrumb Background Alpha',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'breadcrumb_font'             => array(
				'css'       => array( '.breadcrumb', 'font-family' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->fonts,
				'label'     => 'Body Font Family',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'breadcrumb_color'            => array(
				'css'       => array( '.breadcrumb', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'breadcrumb_link_color'       => array(
				'css'       => array( '.breadcrumb a', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'breadcrumb_link_hover_color' => array(
				'css'       => array( '.breadcrumb a:hover', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			)
		);

	}

} // end class

new GSC_Breadcrumbs;
