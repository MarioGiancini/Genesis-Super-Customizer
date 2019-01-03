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

class GSC_Header_Old extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'header_old';

	protected $mod_panel = 'header';

	protected $section_title = 'Older Settings';

	protected $section_desc = 'These header settings mainly apply to older versions of Genesis child themes.';

	protected $section_priority = 50;

	//* Placeholders for variable attributes
	private $header_size_min = 80;

	//* Setup mods here to get for output.
	protected function get_mods() {

		if ( $this->get_field_value( 'logo_height' ) ) {
			$this->header_size_min = $this->get_field_value( 'logo_height' );
		}

		$nav_link_line_height = $this->get_field_value( 'nav_item_line_height' ) ? $this->get_field_value( 'nav_item_line_height' ) : 15;
		$header_size     = $this->get_field_value( 'header_size' ) ? $this->get_field_value( 'header_size' ) : 0;
		$shrink_size     = $this->get_field_value( 'shrink_size' ) ? $this->get_field_value( 'shrink_size' ) : 0;
		$title_font_size = $this->get_field_value( 'title_font_size' ) ? $this->get_field_value( 'title_font_size' ) : 0;

		$this->mod_settings = array(
			'header_size'               => array(
				'css'         => array(
					'.site-header',
					'height',
					'',
					'px',
					true,
					array(
						'media_query' => 'min-width: ' . $this->desktop_min_size . 'px'
					)
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min'  => $this->header_size_min,
					'max'  => 200,
					'step' => 5,
				),
				'description' => 'Sets the height for the header. Recommened: Logo Height + (Header Padding x 2). Used for fixed header and other settings.',
				'option'      => $this->use_option,
			),
			'header_padding'            => array(
				'css'         => array(
					'.site-header .wrap',
					'padding-top padding-bottom',
					'',
					'px',
					true,
					array(
						// default attributes moved here from header_size to be outside of media query
						'affects'        => array( '.site-header' ),
						'affects_values' => array( '.site-header' => 'min-height: initial; position: relative; z-index: 1;' )
					)
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => null,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 5,
				),
				'description' => 'Sets the top and bottom padding for the header.',
				'option'      => $this->use_option,
			),
			'fullwidth_header'          => array(
				'css'      => array(
					'.site-header .wrap',
					'max-width',
					'',
					'%',
					true,
					array(
						'checkbox' => true,
						'value'    => 100,
						'uses'     => array( 'padding-left' => '40px', 'padding-right' => '40px' )
					)
				),
				'priority' => 10,
				'type'     => 'checkbox',
				'default'  => 0,
				'label'    => 'Enable Full Width Header',
				'option'   => $this->use_option,
			),
			'fixed_header'              => array(
				'css'         => array(
					'.site-header',
					'position',
					'',
					'',
					true,
					array(
						'checkbox'       => true,
						'value'          => 'fixed',
						'media_query'    => 'min-width: ' . $this->desktop_min_size . 'px',
						'uses'           => array( 'width' => '100%', 'z-index' => 999 ),
						'affects'        => array( '.bumper' ),
						'affects_values' => array( '.bumper' => 'height: ' . $header_size . 'px;' )
					)
				),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Enable Fixed Header',
				'description' => 'Header shrinks on scroll. Adjust the height below.',
				'option'      => $this->use_option,
			),
			'shrink_size'               => array( // use option to modify shrink css
				'css'         => array(
					'.site-header.shrink',
					'height',
					'',
					'px',
					true,
					array(
						'media_query'    => 'min-width: ' . $this->desktop_min_size . 'px',
						'requires'       => array( 'fixed_header' ),
						'uses'           => array( 'min-height' => 'initial' ),
						'affects'        => array(
							'.shrink .wrap',
							'.shrink .title-area',
							'.shrink .nav-primary',
							'.site-header .genesis-nav-menu > li > a',
							'.shrink .genesis-nav-menu > li > a'
						),
						'affects_values' => array(
							'.shrink .wrap' => 'padding-top: 0; padding-bottom: 0;',
							'.shrink .title-area' => 'padding-top: 0; padding-bottom: 0;',
							'.shrink .nav-primary' => 'padding-top: 0; padding-bottom: 0;',
							'.site-header .genesis-nav-menu > li > a' => 'line-height: ' . $nav_link_line_height . 'px;',
							'.shrink .genesis-nav-menu > li > a' => 'line-height: ' . $shrink_size . 'px; padding-top: 0; padding-bottom: 0;'
						)
					)
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 60,
				'input_attrs' => array(
					'min' => 40,
					'max' => 80,
				),
				'description' => 'Requires fixed header.',
				'option'      => $this->use_option,
			),
			'shrink_opacity'            => array( // use option to modify shrink css
				'css'         => array(
					'.site-header.shrink',
					'opacity',
					'',
					'',
					true,
					array(
						'media_query' => 'min-width: ' . $this->desktop_min_size . 'px',
						'requires'    => array( 'fixed_header' ),
					)
				),
				'priority'    => 10,
				'type'        => 'range',
				'default'     => 95,
				'label'       => 'Shrink Header Opacity',
				'description' => 'Min value is 80%. Requires fixed header.',
				'input_attrs' => array(
					'min' => 80,
					'max' => 100,
				),
				'decimal'     => true,
				'option'      => $this->use_option,
			),
			'shrink_shadow'             => array(
				'css'      => array(
					'.site-header.shrink',
					'box-shadow',
					'',
					'',
					true,
					array(
						'checkbox'    => true,
						'media_query' => 'min-width: ' . $this->desktop_min_size . 'px',
						'value'       => '0 1px 5px rgba(0,0,0,0.15)'
					)
				),
				'priority' => 10,
				'type'     => 'checkbox',
				'default'  => 0,
				'label'    => 'Add a slight box shadow to shrink header.',
				'option'   => $this->use_option,
			),
			'remove_shrink_description' => array(
				'css'         => array(
					'.shrink .site-description',
					'opacity',
					'',
					'',
					true,
					array(
						'checkbox'       => true,
						'value'          => 0,
						'media_query'    => 'min-width: ' . $this->desktop_min_size . 'px',
						'uses'           => array(
							'margin-top' => '-' . ( $shrink_size / 2 ) . 'px;',
							'font-size'  => '0px'
						),
						'affects'        => array( '.site-title', '.shrink .site-title' ),
						'affects_values' => array(
							'.site-title'         => 'line-height: ' . $title_font_size * 1.2 . 'px;',
							'.shrink .site-title' => 'line-height: ' . $shrink_size . 'px;',
						)
					)
				),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 0,
				'label'       => 'Fade Out Description',
				'option'      => $this->use_option,
				'description' => 'Make the description text fade out when header shrinks.',
			)
		);

	}

} // end class

new GSC_Header_Old;
