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
      'site_title_font' => array(
        'css'         => array( '.site-title', 'font-family' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'Lato, sans-serif',
        'choices'     => $this->fonts,
        'option'      => true,
      ),
      'description_font' => array(
        'css'         => array( '.site-description', 'font-family' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'Lato, sans-serif',
        'choices'     => $this->fonts,
        'option'      => true,
      ),
      'title_font_size' => array(
        'css'         => array( '.site-title', 'font-size', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 32,
        'input_attrs' => array(
          'min'   => 12,
          'max'   => 72,
        ),
        'option'      => true,
      ),
      'description_font_size' => array(
        'css'         => array( '.site-description', 'font-size', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 16,
        'input_attrs' => array(
          'min'   => 8,
          'max'   => 64,
        ),
        'option'      => true,
      ),
      'title_font_weight' => array(
        'css'         => array( '.site-title', 'font-weight', '', '' ),
        'priority'    => 10,
        'type'        => 'range',
        'description' => 'From 100 (lightest) to 900 (boldest). Not all fonts support all weights.',
        'default'     => 400,
        'input_attrs' => array(
          'min'   => 100,
          'max'   => 900,
          'step'  => 100,
        ),
        'option'      => true,
      ),
      'description_font_weight' => array(
        'css'         => array( '.site-description', 'font-weight', '', '' ),
        'priority'    => 10,
        'type'        => 'range',
        'description' => 'From 100 (lightest) to 900 (boldest). Not all fonts support all weights.',
        'default'     => 300,
        'input_attrs' => array(
          'min'   => 100,
          'max'   => 900,
          'step'  => 100,
        ),
        'option'      => true,
      ),
      'title_letter_spacing' => array(
        'css'         => array( '.site-title', 'letter-spacing', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'input_attrs' => array(
          'min'   => -10,
          'max'   => 20,
        ),
        'option'      => true,
      ),
      'description_letter_spacing' => array(
        'css'         => array( '.site-description', 'letter-spacing', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'input_attrs' => array(
          'min'   => -10,
          'max'   => 20,
        ),
        'option'      => true,
      ),
      'title_text_style' => array(
        'css'         => array( '.site-title', 'text-transform' ),
        'priority'    => 10,
        'type'        => 'select',
        'choices'     => $this->caps_options,
        'option'      => true,
      ),
      'description_text_style' => array(
        'css'         => array( '.site-description', 'text-transform' ),
        'priority'    => 10,
        'type'        => 'select',
        'choices'     => $this->caps_options,
        'option'      => true,
      ),
      'description_margin' => array(
        'css'         => array( '.title-area .site-description', 'margin-top', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'choices'     => $this->caps_options,
        'description' => 'Change the description spacing (margin-top) to make closer (negative px) or farther away (positive px) from title.',
        'default'     => 0,
        'input_attrs' => array(
          'min'   => -20,
          'max'   => 20,
        ),
        'option'      => true,
      ),
      'description_color' => array(
        'css'         => array( '.title-area .site-description, .custom-header .title-area .site-description', 'color', '', ' !important' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'hide_description' => array(
        'css'         => array( '.title-area .site-description', 'display', '', '', true, array(
          'checkbox'      => true,
          'value'         => 'none'
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'option'      => true,
      ),
      'center_title_text' => array(
        'css'         => array( '.title-area', 'text-align', '', '', true, array(
          'checkbox'        => true,
          'value'           => 'center',
        ) ),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Center The Title Text',
        'description' => 'Also senters the description text.',
        'option'      => true,
      )
    );

  }

} // end class

new GSC_Title_Tagline;
