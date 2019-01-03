<?php

/**
 * Register footer credits customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Footer_Credits extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'footer_credits';

	protected $section_title = 'Footer Credits';

	protected $section_desc = 'Customize the text for the footer credits. You can use Genesis short codes.';

	protected $section_priority = 115;

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'footer_credits_text'        => array(
				'css'      => array(),
				'priority' => 10,
				'type'     => 'textarea',
				'default'  => sprintf( '[footer_copyright before="%s "] • [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="http://www.studiopress.com/" before=""] • [footer_wordpress_link] • [footer_loginout]', __( 'Copyright', 'genesis-super-customizer' ), __( 'on', 'genesis-super-customizer' ) ),
				'option'   => true, // will always store as option
			),
			'footer_credits_background'  => array(
				'css'       => array(
					'.site-footer',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'footer_credits_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'label'     => 'Footer Credits BG Color',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'footer_credits_alpha'       => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Footer Credits BG Alpha',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'footer_credits_transparent' => array(
				'css'         => array(
					'.site-footer',
					'background-color',
					'',
					'',
					true,
					array(
						'checkbox' => true,
						'value'    => 'transparent'
					)
				),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Transparent Footer Credits',
				'description' => 'Will allow main background color to show through.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'credits_text_color'         => array(
				'css'       => array( '.site-footer', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'credits_link_color'         => array(
				'css'       => array( '.site-footer a', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => '',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'credits_link_hover_color'   => array(
				'css'       => array( '.site-footer a:hover', 'color' ),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => '',
				'option'    => $this->use_option,
			),
			'credits_padding_top'        => array(
				'css'         => array( '.site-footer', 'padding-top', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 100,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'credits_padding_bottom'     => array(
				'css'         => array( '.site-footer', 'padding-bottom', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 100,
				),
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			)
		);
	}

} // end class

new GSC_Footer_Credits;
