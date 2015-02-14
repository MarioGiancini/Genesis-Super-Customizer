<?php

/**
* Register buttons customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Buttons extends GSC_Base {

  protected $new_section = true;

  protected $mod_section = 'buttons';

  protected $section_title = 'Button Styles';

  protected $section_desc = 'Create and modify global button styles.';

  protected $section_priority = 100;

  //* Setup mods here to get for output.
  protected function get_mods() {

    $this->mod_settings = array(
      'override_button_colors' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Override Theme Buttone Colors',
        'description' => 'By default your buttons adopt the theme colors. Check to override them and options will appear below.',
        'option'      => true,
      ),
      'button_color' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'background-color', '', '', true, array( 'requires' => array( 'override_button_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'label'       => 'Button Background Color',
        'option'      => true,
      ),
      'button_hover_color' => array(
        'css'         => array( 'button:hover, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover', 'background-color', '', '', true, array( 'requires' => array( 'override_button_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#e5554e',
        'option'      => true,
      ),
      'button_text_color' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'color', '', '', true, array( 'requires' => array( 'override_button_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#fff',
        'option'      => true,
      ),
      'button_text_hover_color' => array(
        'css'         => array( 'button:hover, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover', 'color', '', '', true, array( 'requires' => array( 'override_button_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#fff',
        'option'      => true,
      ),
      'button_font_size' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'font-size', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 16,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
          'class' => 'test-class test',
          'style' => 'color: #e5554e',
        ),
        'option'      => true,
      ),
      'button_font_weight' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'font-weight' ),
        'priority'    => 10,
        'type'        => 'range',
        'description' => 'From 100 (lightest) to 900 (boldest). Not all fonts support all weights.',
        'default'     => 300,
        'input_attrs' => array(
          'min'   => 100,
          'max'   => 900,
          'step'  => 100,
          'class' => $this->mod_section,
          'style' => 'color: #e5554e',
        ),
        'option'      => true,
      ),
      'button_padding_vert' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'padding-top padding-bottom', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 16,
        'label'       => 'Button Padding Vertical',
        'option'      => true,
      ),
      'button_padding_hori' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'padding-left padding-right', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 24,
        'label'       => 'Button Padding Horizontal',
        'option'      => true,
      ),
      'button_border_width' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'border-width', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'min'         => 0,
        'max'         => 20,
        'option'      => true,
      ),
      'button_border_color' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'border-color', '', '', true, array( 'rgba' => 'button_border_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'button_border_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'min'         => 0,
        'max'         => 100,
        'step'        => 5,
        'decimal'     => true,
        'option'      => true,
      ),
      'button_border_style' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'border-style' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'solid',
        'choices'     => $this->border_styles,
        'option'      => true,
      ),
      'button_border_radius' => array(
        'css'         => array( 'button, input[type="button"], input[type="reset"], input[type="submit"], .button', 'border-radius', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 0,
        'min'         => 0,
        'option'      => true,
      )
    );

  }

  /**
  * Filter specific controls to show within content
  */
  public function active_filter( $active, $control ) {

    //* Show color override options if override is checked
    if ( $control->id === 'button_color' || $control->id === 'button_hover_color' || $control->id === 'button_text_color' || $control->id === 'button_text_hover_color' ) {
      $option = $control->manager->get_setting( $this->get_field_name( 'override_button_colors' ) );
      $active = $option->value();
    }

    return $active;
  }

} // end class

new GSC_Buttons;
