<?php

/**
 * Register buttons customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Buttons extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'buttons';

	protected $section_title = 'Button Styles';

	protected $section_desc = 'Create and modify global button styles.';

	protected $section_priority = 100;

	//* Setup mods here to get for output.
	protected function get_mods() {

		$this->mod_settings = array(
			'override_button_colors'  => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Override Theme Button Colors',
				'description' => 'By default your buttons adopt the theme colors. Check to override them and options will appear below.',
				'option'      => true, // will always be stored as an option
			),
			'button_color'            => array(
				'css'             => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'background-color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_button_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Button Background Color',
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_button_colors',
			),
			'button_hover_color'      => array(
				'css'             => array(
					'button:hover, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover',
					'background-color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_button_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'active_callback' => 'override_button_colors',
			),
			'button_text_color'       => array(
				'css'             => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_button_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_button_colors',
			),
			'button_text_hover_color' => array(
				'css'             => array(
					'button:hover, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_button_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'active_callback' => 'override_button_colors',
			),
			'button_font_size'        => array(
				'css'         => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'font-size',
					'',
					'px'
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
			'button_font_weight'      => array(
				'css'         => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'font-weight'
				),
				'priority'    => 10,
				'type'        => 'range',
				'description' => 'From 100 (lightest) to 900 (boldest). Not all fonts support all weights.',
				'default'     => null,
				'input_attrs' => array(
					'min'   => 100,
					'max'   => 900,
					'step'  => 100,
					'class' => $this->mod_section,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'button_padding_vert'     => array(
				'css'         => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'padding-top padding-bottom',
					'',
					'px'
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 50,
				),
				'label'       => 'Button Padding Vertical',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'button_padding_hori'     => array(
				'css'         => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'padding-left padding-right',
					'',
					'px'
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 50,
				),
				'label'       => 'Button Padding Horizontal',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'button_border_width'     => array(
				'css'         => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'border-width',
					'',
					'px'
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 20,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'button_border_color'     => array(
				'css'       => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'border-color',
					'',
					'',
					true,
					array( 'rgba' => 'button_border_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'button_border_alpha'     => array(
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
				'transport'   => 'postMessage',
			),
			'button_border_style'     => array(
				'css'       => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'border-style'
				),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->border_styles,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'button_border_radius'    => array(
				'css'         => array(
					'button, input[type="button"], input[type="reset"], input[type="submit"], .button',
					'border-radius',
					'',
					'px'
				),
				'priority'    => 10,
				'type'        => 'number',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			)
		);

	}

} // end class

new GSC_Buttons;
