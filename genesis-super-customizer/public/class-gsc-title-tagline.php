<?php

/**
 * Register title_tagline customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Title_Tagline extends GSC_Base {

	protected $mod_section = 'title_tagline';

	protected $new_section = false;

	//* Setup mods here to get for output.
	protected function get_mods() {

		$this->mod_settings = array(
			'site_title_font'            => array(
				'css'       => array( '.site-title', 'font-family' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->fonts,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'description_font'           => array(
				'css'       => array( '.site-description', 'font-family' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->fonts,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'title_font_size'            => array(
				'css'         => array( '.site-title', 'font-size', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 12,
					'max' => 72,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'description_font_size'      => array(
				'css'         => array( '.site-description', 'font-size', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 8,
					'max' => 64,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'title_font_weight'          => array(
				'css'         => array( '.site-title', 'font-weight', '', '' ),
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
			'description_font_weight'    => array(
				'css'         => array( '.site-description', 'font-weight', '', '' ),
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
			'title_letter_spacing'       => array(
				'css'         => array( '.site-title', 'letter-spacing', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => - 10,
					'max' => 20,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'description_letter_spacing' => array(
				'css'         => array( '.site-description', 'letter-spacing', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => - 10,
					'max' => 20,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'title_text_style'           => array(
				'css'       => array( '.site-title', 'text-transform' ),
				'priority'  => 10,
				'type'      => 'select',
				'choices'   => $this->caps_options,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'description_text_style'     => array(
				'css'       => array( '.site-description', 'text-transform' ),
				'priority'  => 10,
				'type'      => 'select',
				'choices'   => $this->caps_options,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'description_margin'         => array(
				'css'         => array( '.title-area .site-description', 'margin-top', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'choices'     => $this->caps_options,
				'description' => 'Change the description spacing (margin-top) to make closer (negative px) or farther away (positive px) from title.',
				'default'     => null,
				'input_attrs' => array(
					'min' => - 20,
					'max' => 20,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'description_color'          => array(
				'css'       => array(
					'.title-area .site-description, .custom-header .title-area .site-description',
					'color',
					'',
					' !important'
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'hide_description'           => array(
				'css'       => array(
					'.title-area .site-description',
					'display',
					'',
					'',
					true,
					array(
						'checkbox' => true,
						'value'    => 'none'
					)
				),
				'priority'  => 10,
				'type'      => 'checkbox',
				'default'   => 0,
				'description' => 'This is only relevant in older Genesis child themes. New Sample child theme does not show description in header.',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'title_area_padding'         => array(
				'css'         => array( '.title-area', 'padding-top padding-bottom', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 40,
				),
				'description' => 'Top and bottom padding for title area. Use to help center text within the logo height setting.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'center_title_text'          => array(
				'css'         => array(
					'.title-area',
					'text-align',
					'',
					'',
					true,
					array(
						'checkbox' => true,
						'value'    => 'center',
					)
				),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Center The Title Text',
				'description' => 'Also centers the description text.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			)
		);

	}

} // end class

new GSC_Title_Tagline;
