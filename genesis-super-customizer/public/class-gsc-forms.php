<?php

/**
* Register forms customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Forms extends GSC_Base {

  protected $new_section = true;

  protected $mod_section = 'forms';

  protected $section_title = 'Form Settings';

  protected $section_desc = 'Adjust inputs and textarea styles.';

  protected $section_priority = 100;

  //* Setup mods here to get for output
  protected function get_mods() {

    $this->mod_settings = array(
      'input_text_color' => array(
        'css'         => array( 'input, select, textarea', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'description' => 'Affects inputs, textareas, and select boxes.',
        'option'      => true,
      ),
      'input_background_color' => array(
        'css'         => array( 'input, select, textarea', 'background-color', '', '', true, array( 'rgba' => 'input_background_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'description' => 'Affects inputs, textareas, and select boxes.',
        'option'      => true,
      ),
      'input_background_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'input_border_color' => array(
        'css'         => array( 'input, select, textarea, .enews-widget input', 'border-color', '', '', true, array( 'rgba' => 'input_border_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'input_border_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'overwrite_input_colors' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'description' => 'This will overwrite the theme accent color defaults for the items below.',
        'option'      => true,
      ),
      'placeholder_text_color' => array(
        'css'         => array( '::-webkit-input-placeholder', 'color', '', '', true, array(
          'requires' => array( 'overwrite_input_colors' ),
          'siblings' => array( ':-moz-placeholder' => 'color', '::-moz-placeholder' => 'color', ':-ms-input-placeholder' => 'color' )
        ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'description' => 'Affects inputs, textareas, and select boxes.',
        'option'      => true,
      ),
      'input_focus_border_color' => array(
        'css'         => array( 'input:focus, textarea:focus, .enews-widget input:focus', 'border-color', '', '', true, array( 'rgba' => 'input_focus_border_alpha', 'requires' => array( 'overwrite_input_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'input_focus_border_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      )
    );

  }

  /**
  * Filter specific controls to show within content
  */
  public function active_filter( $active, $control ) {

    //* Show color override options if override is checked
    if ( $control->id === 'placeholder_text_color' || $control->id === 'input_focus_border_color' || $control->id === 'input_focus_border_alpha' ) {
      $option = $control->manager->get_setting( $this->get_field_name( 'overwrite_input_colors' ) );
      $active = $option->value();
    }

    return $active;
  }

} // end class

new GSC_Forms;
