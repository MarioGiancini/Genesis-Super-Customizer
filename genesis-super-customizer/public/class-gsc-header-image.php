<?php

/**
* Register header image customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Header_Image extends GSC_Base {

  protected $settings_field = 'genesis-customizer-settings';

  protected $new_section = false;

  protected $mod_section = 'header_image';

  //* Placeholders for variable attributes
  private $logo_width_max = 1200;

  //* Setup mods here to get for output.
  protected function get_mods() {

    //* If the max width has been increased, change the logo max width also.
    if( $this->get_field_value( 'wrap_width' ) ) {
      $this->logo_width_max = $this->get_field_value( 'wrap_width' );
    }

    $this->mod_settings = array(
      'logo_width' => array(
        'css'         => array( '.title-area', 'width', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 320,
        'input_attrs' => array(
          'min'   => 100,
          'max'   => $this->logo_width_max,
          'step'  => 10,
        ),
        'description' => 'If you adjust this you may have to re-upload your logo for the new size. Max since depends on content wrap width.',
        'option'      => true,
      ),
      'logo_height' => array(
        'css'         => array( '.title-area', 'height', '', 'px', true, array(
          // 'media_query'   => 'min-width: ' . $this->desktop_min_size . 'px',
          'affects'       => array( '.site-header .genesis-nav-menu > li > a', '.header-image .title-area', '.header-image .site-title > a'  ),
          'affects_values'=> array( '.site-header .genesis-nav-menu > li > a' => 'line-height: ' .  $this->get_field_value( 'logo_height' ) . 'px; padding-top: 0px; padding-bottom: 0px;', '.header-image .title-area' => 'padding: 0;', '.header-image .site-title > a' => 'background-size: contain !important; min-height: initial; height: ' .  $this->get_field_value( 'logo_height' ) . 'px;' )
        ) ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 80,
        'input_attrs' => array(
          'min'   => 40,
          'max'   => 200,
          'step'  => 5,
        ),
        'description' => 'If you adjust this you may have to re-upload your logo for the new size. Save, close, and reopen customizer to see changes in description above.',
        'option'      => true,
      ),
      'flex_crop' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Enable Flexable Image Cropping',
        'description' => 'When you update this option, close out and restart Customizer for it to take effect.',
        'option'      => true,
      ),
      'header_hover_opacity' => array(
        'css'         => array( '.custom-header .site-title a:hover', 'opacity' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Header Logo Hover Opacity',
        'description' => 'Have the Site Title / Logo fade when hovering over it. Choose Opacity 0% to 100%.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'fullwidth_image' => array(
        'css'         => array( '.title-area', 'width', '', '% !important', true, array(
          'checkbox'        => true,
          'value'           => '100',
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Make Header Image Full Width',
        'option'      => true,
      ),
      'force_fullwidth_image' => array(
        'css'         => array( '.title-area', 'width', '', '% !important', true, array(
          'media_query' => 'max-width: ' . $this->mobile_max_size . 'px',
          'checkbox'    => true,
          'value'       => '100',
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Force Mobile Fullwidth Image',
        'description' => 'Force the header image / logo to be full width instead of specified logo width on mobile screens.',
        'option'      => true,
      ),
      'center_image' => array(
        'css'         => array( '.header-image .site-title > a', 'background-position', '', '% !important', true, array(
          'checkbox'        => true,
          'value'           => '50',
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Center The Header Image',
        'option'      => true,
      )
    );

  }

} // end class

new GSC_Header_Image;
