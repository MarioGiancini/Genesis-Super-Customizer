<?php

/**
* Register footer customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Footer extends GSC_Base {

  protected $new_section = true;

  protected $mod_section = 'footer';

  protected $section_title = 'Footer Settings';

  protected $section_desc = 'Adjust styles for the footer widgets and footer credits areas.';

  protected $section_priority = 115;

  //* Setup mods here to get for output
  protected function get_mods() {

    $this->mod_settings = array(
      'footer_list_item_border_color' => array(
        'css'         => array( '.footer-widgets li', 'border-color', '', '', true, array( 'rgba' => 'footer_list_item_border_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'option'      => true,
      ),
      'footer_list_item_border_alpha' => array(
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
      'footer_list_item_border_style' => array(
        'css'         => array( '.footer-widgets li', 'border-bottom-style' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'dotted',
        'choices'     => $this->border_styles,
        'option'      => true,
      ),
      'footer_list_item_border_width' => array(
        'css'         => array( '.footer-widgets li', 'border-bottom-width', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 1,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 15,
        ),
        'option'      => true,
      ),
      'override_footer_colors' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'label'       => 'Override Theme Colors',
        'description' => 'By default your footer will adopt the theme background colors and neutral text colors. Check to override them.',
        'option'      => true,
      ),
      'footer_widgets_background' => array(
        'css'         => array( '.footer-widgets', 'background-color', '', '', true, array( 'rgba' => 'footer_widgets_alpha', 'requires' => array( 'override_footer_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'label'       => 'Footer Widgets Background Color',
        'option'      => true,
      ),
      'footer_widgets_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Footer Widgets Background Alpha',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'footer_title_color' => array(
        'css'         => array( '.footer-widgets .widget-title', 'color', '', '', true, array( 'requires' => array( 'override_footer_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#fff',
        'label'       => 'Footer Widgets Title Color',
        'option'      => true,
      ),
      'footer_text_color' => array(
        'css'         => array( '.footer-widgets', 'color', '', '', true, array( 'requires' => array( 'override_footer_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#999',
        'option'      => true,
      ),
      'footer_link_color' => array(
        'css'         => array( '.footer-widgets a', 'color', '', '', true, array( 'requires' => array( 'override_footer_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#999',
        'option'      => true,
      ),
      'footer_link_hover_color' => array(
        'css'         => array( '.footer-widgets a:hover', 'color', '', '', true, array( 'requires' => array( 'override_footer_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#fff',
        'option'      => true,
      )
    );

  }

  /**
  * Filter specific controls to show within content
  */
  public function active_filter( $active, $control ) {

    //* Show color override options if override is checked
    if ( $control->id === 'footer_widgets_background' || $control->id === 'footer_widgets_alpha' || $control->id === 'footer_title_color' || $control->id === 'footer_text_color' || $control->id === 'footer_link_color' || $control->id === 'footer_link_hover_color' ) {
      $option = $control->manager->get_setting( $this->get_field_name( 'override_footer_colors' ) );
      $active = $option->value();
    }

    return $active;
  }

} // end class

new GSC_Footer;
