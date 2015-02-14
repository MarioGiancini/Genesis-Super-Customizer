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

  protected $settings_field = 'genesis-customizer-settings';

  protected $new_section = true;

  protected $mod_section = 'header';

  protected $section_title = 'Header Settings';

  protected $section_desc = 'Use these options to customize the look and response of your site header.';

  protected $section_priority = 50;

  //* Placeholders for variable attributes
  private $header_size_min = 80;

  //* Setup mods here to get for output.
  protected function get_mods() {

    if( $this->get_field_value( 'logo_height' ) ) {
      $this->header_size_min = $this->get_field_value( 'logo_height' );
    }

    $this->mod_settings = array(
      'header_size' => array(
        'css'         => array( '.site-header', 'height', '', 'px', true, array(
          'media_query' => 'min-width: ' . $this->desktop_min_size . 'px',
          'uses'        => array( 'min-height' => 'initial' )
        ) ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 160,
        'input_attrs' => array(
          'min'   => $this->header_size_min,
          'max'   => 200,
          'step'  => 5,
        ),
        'description' => 'Sets the height for the header. Recommened: Logo Height + Header Padding.',
        'option'      => true,
      ),
      'header_padding' => array(
        'css'         => array( '.site-header .wrap', 'padding-top padding-bottom', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 40,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'option'      => true,
      ),
      'fullwidth_header' => array(
        'css'         => array( '.site-header .wrap', 'max-width', '', '%', true, array(
          'checkbox'  => true,
          'value'     => 100,
          'uses'      => array( 'padding-left' => '40px', 'padding-right' => '40px' )
          ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Enable Full Width Header',
        'option'      => true,
      ),
      'fixed_header' => array(
        'css'         => array( '.site-header', 'position', '', '', true, array(
          'checkbox'        => true,
          'value'           => 'fixed',
          'media_query'     => 'min-width: ' . $this->desktop_min_size . 'px',
          'uses'            => array( 'width' => '100%', 'z-index' => 999 ),
          'affects'         => array( '.bumper' ),
          'affects_values'  => array( '.bumper' => 'height: ' . $this->get_field_value( 'header_size' ) . 'px;' )
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Enable Fixed Header',
        'description' => 'Header shrinks on scroll. Adjust the height below.',
        'option'      => true,
      ),
      'shrink_size' => array( // use option to modify shrink css
        'css'         => array( '.site-header.shrink', 'height', '', 'px', true, array(
          'media_query'     => 'min-width: ' . $this->desktop_min_size . 'px',
          'requires'        => array( 'fixed_header' ),
          'uses'            => array( 'min-height' => 'initial' ),
          'affects'         => array( '.shrink .wrap', '.shrink .title-area', '.shrink .genesis-nav-menu > li > a' ),
          'affects_values'  => array( '.shrink .wrap' => 'padding-top: 0px; padding-bottom: 0px;', '.shrink .title-area' => 'padding: 0px;', '.shrink .genesis-nav-menu > li > a' => 'line-height: ' .  $this->get_field_value( 'shrink_size' ) . 'px; padding-top: 0px; padding-bottom: 0px;' )
        ) ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 60,
        'input_attrs' => array(
          'min'   => 40,
          'max'   => 80,
        ),
        'description' => 'Requires fixed header.',
        'option'      => true,
      ),
      'shrink_opacity' => array( // use option to modify shrink css
        'css'         => array( '.site-header.shrink', 'opacity', '', '', true, array(
          'media_query' => 'min-width: ' . $this->desktop_min_size . 'px',
          'requires'    => array( 'fixed_header' ),
        ) ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 95,
        'option'      => true,
        'label'       => 'Shrink Header Opacity',
        'description' => 'Min value is 80%. Requires fixed header.',
        'input_attrs' => array(
          'min'   => 80,
          'max'   => 100,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'shrink_shadow' => array(
        'css'         => array( '.site-header.shrink', 'box-shadow', '', '', true, array(
          'checkbox'    => true,
          'media_query' => 'min-width: ' . $this->desktop_min_size . 'px',
          'value'       => '0 1px 5px rgba(0,0,0,0.15)' ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Add a slight box shadow to shrink header.',
        'option'      => true,
      ),
      'remove_shrink_description' => array(
        'css'         => array( '.shrink .site-description', 'opacity', '', '', true, array(
          'checkbox'      => true,
          'value'         => 0,
          'media_query'   => 'min-width: ' . $this->desktop_min_size . 'px',
          'uses'          => array( 'margin-top' => '-' . ( $this->get_field_value( 'shrink_size' ) / 2 ) . 'px;', 'font-size' => '0px' ),
          'affects'       => array( '.site-title', '.shrink .site-title' ),
          'affects_values'=> array(
            '.site-title' => 'line-height: ' .  $this->get_field_value( 'title_font_size' )*1.2 . 'px;',
            '.shrink .site-title' => 'line-height: ' .  $this->get_field_value( 'shrink_size' ) . 'px;',
            )
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Fade Out Description',
        'option'      => true,
        'description' => 'Make the description text fade out when header shrinks.',
      ),
      'header_border_width' => array(
        'css'         => array( '.site-header', 'border-bottom', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'description' => 'Set the header bottom border up to 15px.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 15,
        ),
        'option'      => true,
      ),
      'header_border_color' => array(
        'css'         => array( '.site-header', 'border-bottom-color', '', '', true, array( 'rgba' => 'header_border_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'header_border_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'description' => '0% to 100%.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'header_border_style' => array(
        'css'         => array( '.site-header', 'border-bottom-style' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'solid',
        'choices'     => $this->border_styles,
        'option'      => true,
      )
    );

  }

} // end class

new GSC_Header;
