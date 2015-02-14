<?php

/**
* Register breadcrumb customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Breadcrumbs extends GSC_Base {

  protected $mod_section = 'genesis_breadcrumbs';

  protected $new_section = false;

  //* Setup mods here to get for output
  protected function get_mods() {

    $this->mod_settings = array(
      'breadcrumb_padding' => array(
        'css'         => array( '.breadcrumb', 'padding', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 80,
        ),
        'option'      => true,
      ),
      'breadcrumb_background_color' => array(
        'css'         => array( '.breadcrumb', 'background-color', '', '', true, array( 'rgba' => 'breadcrumb_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'breadcrumb_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Breadcrumb Background Alpha',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'breadcrumb_font' => array(
        'css'         => array( '.breadcrumb', 'font-family' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'Lato, sans-serif',
        'choices'     => $this->fonts,
        'label'       => 'Body Font Family',
        'option'      => true,
      ),
      'breadcrumb_color' => array(
        'css'         => array( '.breadcrumb', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'breadcrumb_link_color' => array(
        'css'         => array( '.breadcrumb a', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'breadcrumb_link_hover_color' => array(
        'css'         => array( '.breadcrumb a:hover', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      )
    );

  }

} // end class

new GSC_Breadcrumbs;
