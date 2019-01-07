<?php

/**
 * Register footer customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Footer extends GSC_Base {

	protected $new_panel = true;

	protected $mod_panel = 'footer';

	protected $panel_title = 'Footer';

	protected $panel_desc = 'Settings to customize the look and response of your site footer.';

	protected $panel_priority = 115;

	protected $new_section = true;

	protected $mod_section = 'footer_layout';

	protected $section_title = 'Footer Layout';

	protected $section_desc = 'Adjust styles for the footer widgets and footer credits areas.';

	protected $section_priority = 10;

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'footer_border_top_color' => array(
				'css'       => array(
					'.site-footer',
					'border-color',
					'',
					'',
					true,
					array( 'rgba' => 'footer_border_top_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'footer_border_top_alpha' => array(
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
			'footer_border_top_border_style' => array(
				'css'       => array( '.site-footer', 'border-top-style' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->border_styles,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'footer_border_top_border_width' => array(
				'css'         => array( '.site-footer', 'border-top-width', '', 'px' ),
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
			'footer_border_bottom_border_style' => array(
				'css'       => array( '.site-footer', 'border-bottom-style' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->border_styles,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'footer_border_bottom_border_width' => array(
				'css'         => array( '.site-footer', 'border-bottom-width', '', 'px' ),
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
			'footer_list_item_border_color' => array(
				'css'       => array(
					'.footer-widgets li',
					'border-color',
					'',
					'',
					true,
					array( 'rgba' => 'footer_list_item_border_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'footer_list_item_border_alpha' => array(
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
			'footer_list_item_border_style' => array(
				'css'       => array( '.footer-widgets li', 'border-bottom-style' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->border_styles,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'footer_list_item_border_width' => array(
				'css'         => array( '.footer-widgets li', 'border-bottom-width', '', 'px' ),
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
			'override_footer_colors'        => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Override Theme Colors',
				'description' => 'By default your footer will adopt the theme background colors and neutral text colors. Check to override them.',
				'option'      => true, // will always be stored as an option
			),
			'footer_widgets_background'     => array(
				'css'             => array(
					'.footer-widgets',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'footer_widgets_alpha', 'requires' => array( 'override_footer_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Footer Widgets Background Color',
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_footer_colors',
			),
			'footer_widgets_alpha'          => array(
				'css'             => array(),
				'priority'        => 10,
				'type'            => 'range',
				'default'         => 100,
				'label'           => 'Footer Widgets Background Alpha',
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'         => true,
				'option'          => $this->use_option,
				'active_callback' => 'override_footer_colors',
			),
			'footer_title_color'            => array(
				'css'             => array(
					'.footer-widgets .widget-title',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_footer_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'label'           => 'Footer Widgets Title Color',
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_footer_colors',
			),
			'footer_text_color'             => array(
				'css'             => array(
					'.footer-widgets',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_footer_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_footer_colors',
			),
			'footer_link_color'             => array(
				'css'             => array(
					'.footer-widgets a',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_footer_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'transport'       => 'postMessage',
				'active_callback' => 'override_footer_colors',
			),
			'footer_link_hover_color'       => array(
				'css'             => array(
					'.footer-widgets a:hover',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_footer_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'active_callback' => 'override_footer_colors',
			)
		);

	}

} // end class

new GSC_Footer;
