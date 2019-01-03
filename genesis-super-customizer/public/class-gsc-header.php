<?php

/**
 * Register header customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Header extends GSC_Base {

	protected $new_section = true;

	protected $new_panel = true;

	protected $mod_panel = 'header';

	protected $panel_title = 'Header';

	protected $panel_desc = 'Settings to customize the look and response of your site header. Includes options for older and new Sample child themes';

	protected $mod_section = 'header_border';

	protected $section_title = 'Border Settings';

	protected $section_desc = 'Use these options to customize the look and response of your site header.';

	protected $section_priority = 50;

	//* Placeholders for variable attributes
	private $header_size_min = 80;

	//* Setup mods here to get for output.
	protected function get_mods() {

		if ( $this->get_field_value( 'logo_height' ) ) {
			$this->header_size_min = $this->get_field_value( 'logo_height' );
		}

		$header_size     = $this->get_field_value( 'header_size' ) ? $this->get_field_value( 'header_size' ) : 0;
		$shrink_size     = $this->get_field_value( 'shrink_size' ) ? $this->get_field_value( 'shrink_size' ) : 0;
		$title_font_size = $this->get_field_value( 'title_font_size' ) ? $this->get_field_value( 'title_font_size' ) : 0;

		$this->mod_settings = array(
			'header_border_width'       => array(
				'css'         => array( '.site-header', 'border-bottom', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'description' => 'Set the header bottom border up to 15px.',
				'input_attrs' => array(
					'min' => 0,
					'max' => 15,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'header_border_color'       => array(
				'css'       => array(
					'.site-header',
					'border-bottom-color',
					'',
					'',
					true,
					array( 'rgba' => 'header_border_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'header_border_alpha'       => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'description' => '0% to 100%.',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'header_border_style'       => array(
				'css'       => array( '.site-header', 'border-bottom-style' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->border_styles,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			)
		);

	}

} // end class

new GSC_Header;
