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
      'footer_credits_text' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'textarea',
        'default'     => 'Copyright [footer_copyright] [footer_childtheme_link] - [footer_genesis_link] [footer_studiopress_link] - [footer_wordpress_link] - [footer_loginout]',
        'option'      => true,
      ),
      'footer_credits_background' => array(
        'css'         => array( '.site-footer', 'background-color', '', '', true, array( 'rgba' => 'footer_credits_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'label'       => 'Footer Credits BG Color',
        'option'      => true,
      ),
      'footer_credits_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Footer Credits BG Alpha',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'footer_credits_transparent' => array(
        'css'         => array( '.site-footer', 'background-color', '', '', true, array(
          'checkbox'    => true,
          'value'       => 'transparent' ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Transparent Footer Credits',
        'description' => 'Will allow main background color to show through.',
        'option'      => true,
      ),
      'credits_text_color' => array(
        'css'         => array( '.site-footer', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'credits_link_color' => array(
        'css'         => array( '.site-footer a', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'credits_link_hover_color' => array(
        'css'         => array( '.site-footer a:hover', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'credits_padding_top' => array(
        'css'         => array( '.site-footer', 'padding-top', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 40,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
        ),
        'option'      => true,
      ),
      'credits_padding_bottom' => array(
        'css'         => array( '.site-footer', 'padding-bottom', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 40,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
        ),
        'option'      => true,
      )
    );
  }

} // end class

new GSC_Footer_Credits;
