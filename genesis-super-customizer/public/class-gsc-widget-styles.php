<?php

/**
 * Register widget styles customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Widget_Styles extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'widget_styles';

	protected $section_title = 'Widget Styles';

	protected $section_desc = 'Adjust styles for widgets in the sidebars.';

	protected $section_priority = 115;

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'sidebar_widget_padding'    => array(
				'css'         => array( '.sidebar .widget', 'padding', '', 'px' ),
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
			'sidebar_widget_background' => array(
				'css'         => array(
					'.sidebar .widget, .sidebar .widget.enews-widget',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'sidebar_widget_alpha' )
				),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'label'       => 'Widget Background Color',
				'description' => 'For Sidebar Widgets.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'sidebar_widget_alpha'      => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Widget Background Alpha',
				'description' => 'For Sidebar Widgets.',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'widget_enews_slick_signup' => array(
				'css'         => array(
					'.enews-widget input[type="submit"]',
					'position',
					'',
					'',
					true,
					array(
						'checkbox'       => true,
						'value'          => 'absolute',
						'uses'           => array(
							'bottom'  => '1px',
							'margin'  => '0',
							'padding' => '16px',
							'right'   => '1px',
							'width'   => 'initial'
						),
						'affects'        => array( '.enews form', '.enews-widget input[type="email"]' ),
						'affects_values' => array(
							'.enews form'                       => 'position: relative;',
							'.enews-widget input[type="email"]' => 'margin-bottom: 0; padding-right: 100px;'
						)
					)
				),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Enable eNews Slick Signup',
				'description' => 'Add "slick signup" style to eNews Extended widget. Puts the subscribe button inside the email input.',
				'option'      => $this->use_option,
			)
		);

	}

} // end class

new GSC_Widget_Styles;
