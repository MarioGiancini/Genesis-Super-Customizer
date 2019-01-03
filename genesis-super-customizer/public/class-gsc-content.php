<?php

/**
 * Register content customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Content extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'content';

	protected $section_title = 'Content Settings';

	protected $section_desc = 'Adjust wraps and content area sizes and styles.';

	protected $section_priority = 100;

	//* Setup mods here to get for output
	protected function get_mods() {

		$wrap_width = $this->get_field_value( 'wrap_width' ) ? $this->get_field_value( 'wrap_width' ) : 0;

		$this->mod_settings = array(
			'wrap_width'                => array(
				'css'         => array(
					'.site-inner, .wrap',
					'max-width',
					'',
					'px',
					true,
					array(
						'media_query'     => 'min-width: ' . $wrap_width . 'px',
						'affects'         => array(
							'.content',
							'.content-sidebar-sidebar .content, .sidebar-content-sidebar .content, .sidebar-sidebar-content .content',
							'.sidebar-primary',
							'.sidebar-secondary',
							'.content-sidebar-sidebar .content-sidebar-wrap, .sidebar-content-sidebar .content-sidebar-wrap, .sidebar-sidebar-content .content-sidebar-wrap',
							'.footer-widgets-1, .footer-widgets-2, .footer-widgets-3',
							'.footer-widgets-1'
						),
						'affects_factors' => array(
							'.content'                                                                                                                                       => array( 'width' => 0.65 ),
							'.content-sidebar-sidebar .content, .sidebar-content-sidebar .content, .sidebar-sidebar-content .content'                                        => array( 'width' => 0.49 ),
							'.sidebar-primary'                                                                                                                               => array( 'width' => 0.29 ),
							'.sidebar-secondary'                                                                                                                             => array( 'width' => 0.15 ),
							'.content-sidebar-sidebar .content-sidebar-wrap, .sidebar-content-sidebar .content-sidebar-wrap, .sidebar-sidebar-content .content-sidebar-wrap' => array( 'width' => 0.82 ),
							'.footer-widgets-1, .footer-widgets-2, .footer-widgets-3'                                                                                        => array( 'width' => 0.3 ),
							'.footer-widgets-1'                                                                                                                              => array( 'margin-right' => 0.05 )
						)
					)
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'label'       => 'Increase the wrap max width.',
				'description' => 'Will automatically create appropriate widths for content and sidebars.',
				'input_attrs' => array(
					'min'  => 1140,
					'max'  => 1600,
					'step' => 10,
				),
				'option'      => $this->use_option,
			),
			'content_inner_padding_top' => array(
				'css'         => array( '.site-inner', 'padding-top', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 100,
				),
				'label'       => 'Inner Content Top Padding',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'page_post_padding'         => array(
				'css'         => array( '.entry', 'padding', '', 'px' ),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min' => 0,
					'max' => 80,
				),
				'label'       => 'Page And Post Padding',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'content_background_color'  => array(
				'css'         => array(
					'.content .entry, .comment-respond, .entry-comments, .entry-pings, .form-allowed-tags, .sidebar .widget',
					'background-color',
					'',
					'',
					true,
					array( 'rgba' => 'content_alpha' )
				),
				'priority'    => 10,
				'type'        => 'color',
				'default'     => null,
				'description' => 'Affects background for content areas, comment areas, and sidebar widgets.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'content_alpha'             => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 100,
				'label'       => 'Content Background Alpha',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'body_font'                 => array(
				'css'       => array( 'body', 'font-family' ),
				'priority'  => 10,
				'type'      => 'select',
				'default'   => null,
				'choices'   => $this->fonts,
				'label'     => 'Body Font Family',
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'heading_text_font'         => array(
				'css'         => array( 'h1, h2, h3, h4, h5, h6', 'font-family' ),
				'priority'    => 10,
				'type'        => 'select',
				'default'     => null,
				'choices'     => $this->fonts,
				'description' => 'For heading tags h1 through h6.',
				'option'      => $this->use_option,
				'transport'   => 'postMessage',
			),
			'entry_meta_border_color'   => array(
				'css'       => array(
					'.entry-footer .entry-meta, .featured-content .entry',
					'border-color',
					'',
					'',
					true,
					array( 'rgba' => 'entry_meta_border_alpha' )
				),
				'priority'  => 10,
				'type'      => 'color',
				'default'   => null,
				'option'    => $this->use_option,
				'transport' => 'postMessage',
			),
			'entry_meta_border_alpha'   => array(
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
			)
		);

	}

} // end class

new GSC_Content;
