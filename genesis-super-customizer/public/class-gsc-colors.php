<?php

/**
 * Register colors customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Colors extends GSC_Base {

	protected $mod_section = 'colors';

	protected $new_section = false;

	//* Setup mods here to get for output.
	protected function get_mods() {

		$this->mod_settings = array(
			'theme_main_color'        => array(
				'css'         => array(
					'a:not(.button), .site-title a, .genesis-nav-menu a:hover, .genesis-nav-menu a:focus, .nav-primary .genesis-nav-menu a:hover, .nav-primary .genesis-nav-menu .current-menu-item > a, .genesis-nav-menu .current-menu-item > a, .nav-primary .genesis-nav-menu .sub-menu .current-menu-item > a:hover, .genesis-nav-menu .sub-menu .current-menu-item > a:hover, .genesis-nav-menu .sub-menu .current-menu-item > a:focus, .entry-title a:hover, .theme-color, .menu-toggle:focus, .menu-toggle:hover, .sub-menu-toggle:focus, .sub-menu-toggle:hover',
					'color',
					'',
					'',
					true,
					array(
						'siblings' => array(
							'.theme-bg'                                                                                                                                                                                                                                                          => 'background-color',
							'.enews-widget input[type="submit"], button:hover, button:focus, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover, .button:focus, input:focus[type="button"], input:focus[type="reset"], input:focus[type="submit"]' => 'background-color',
							'.archive-pagination li a:hover, .archive-pagination li a:focus, .archive-pagination .active a'                                                                                                                                                                      => 'background-color'
						)
					)
				),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'description' => 'Will be set to site header text color, links color, post title hover color, button color, and header nav hover color.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'theme_accent_color'      => array(
				'css'         => array(
					'a:not(.button):hover, .site-title a:hover, .entry-title a, .accent-color',
					'color',
					'',
					'',
					true,
					array(
						'siblings' => array(
							'.accent-bg'                                                                       => 'background-color',
							'.sidebar .widget.enews-widget'                                                    => 'background-color',
							'.footer-widgets'                                                                  => 'background-color',
							'button, input[type="button"], input[type="reset"], input[type="submit"], .button' => 'background-color',
							'input:focus, textarea:focus'                                                      => 'border-color',
							'::-webkit-input-placeholder'                                                      => 'color',
							':-moz-placeholder'                                                                => 'color',
							'::-moz-placeholder'                                                               => 'color',
							':-ms-input-placeholder'                                                           => 'color'
						)
					)
				),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'description' => 'Will be set to links hover color, post title color, placeholder color, input focus border, primary nav background, and footer widgets background.',
				'option'      => $this->use_option,
			),
			'bg_color'                => array(
				'css'      => array(
					'body, .main-bg',
					'background-color',
					'',
					'',
					true,
					array( 'siblings' => array( '.bg-color' => 'color' ) )
				),
				'priority' => 10,
				'type'     => 'color',
				'default'  => null,
				'label'    => 'Background Color',
				'option'   => $this->use_option,
				'transport'   => 'postMessage',
			),
			'header_background_color' => array(
				'css'      => array(
					'.site-header',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'header_background_alpha' )
				),
				'priority' => 10,
				'type'     => 'color',
				'default'  => null,
				'option'   => $this->use_option,
				'transport'   => 'postMessage',
			),
			'header_background_alpha' => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Header Background Alpha',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'body_text_color'         => array(
				'css'      => array( 'body', 'color' ),
				'priority' => 10,
				'type'     => 'color',
				'default'  => null,
				'option'   => $this->use_option,
				'transport'   => 'postMessage',
			),
			'heading_text_color'      => array(
				'css'         => array( 'h1, h2, h3, h4, h5, h6', 'color' ),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'description' => 'For heading tags h1 through h6.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'link_decoration'         => array(
				'css'      => array(
					'a:not(.button), .genesis-nav-menu a, .genesis-nav-menu .current-menu-item > a, .nav-primary .genesis-nav-menu .current-menu-item > a',
					'text-decoration'
				),
				'priority' => 10,
				'type'     => 'select',
				'default'  => null,
				'choices'  => $this->decorations,
				'option'   => $this->use_option,
			),
			'link_hover_decoration'   => array(
				'css'         => array(
					'a:not(.button):hover, a:focus, .genesis-nav-menu a:hover, .genesis-nav-menu a:focus, .nav-primary .genesis-nav-menu a:hover, .nav-primary .genesis-nav-menu a:focus, .genesis-nav-menu .sub-menu .current-menu-item > a:hover, .genesis-nav-menu .sub-menu .current-menu-item > a:focus',
					'text-decoration'
				),
				'priority'    => 10,
				'type'        => 'select',
				'default'     => null,
				'description' => 'Text decoration for link hover and focus.',
				'choices'     => $this->decorations,
				'option'      => $this->use_option,
			),
			'override_link_colors'    => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'description' => 'Check to override the theme color defaults for links. Options will appear below.',
				'option'      => true, // will always be stored as option
			),
			'link_text_color'         => array(
				'css'             => array(
					'a',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_link_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'transport'   => 'postMessage',
				'active_callback' => 'override_link_colors',
			),
			'link_hover_color'        => array(
				'css'             => array(
					'a:hover',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_link_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'active_callback' => 'override_link_colors',
			),
			'post_title_text_color'   => array(
				'css'             => array(
					'.entry-title a',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_link_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'transport'   => 'postMessage',
				'active_callback' => 'override_link_colors',
			),
			'post_title_hover_color'  => array(
				'css'             => array(
					'.entry-title a:hover',
					'color',
					'',
					'',
					true,
					array( 'requires' => array( 'override_link_colors' ) )
				),
				'priority'        => 10,
				'type'            => 'color',
				'default'         => null,
				'option'          => $this->use_option,
				'active_callback' => 'override_link_colors',
			)
		);

	}

} // end class

new GSC_Colors;
