<?php

/**
* Register widget styles customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Widget_Styles extends GSC_Base {

  protected $new_section = true;

  protected $mod_section = 'widget_styles';

  protected $section_title = 'Widget Styles';

  protected $section_desc = 'Adjust styles for widgets in the sidebars.';

  protected $section_priority = 115;

  //* Setup mods here to get for output
  protected function get_mods() {

    $this->mod_settings = array(
      'sidebar_widget_padding' => array(
        'css'         => array( '.sidebar .widget', 'padding', '', 'px' ),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 40,
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 80,
        ),
        'option'      => true,
      ),
      'sidebar_widget_background' => array(
        'css'         => array( '.sidebar .widget, .sidebar .widget.enews-widget', 'background-color', '', '', true, array( 'rgba' => 'sidebar_widget_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'label'       => 'Widget Background Color',
        'description' => 'For Sidebar Widgets.',
        'option'      => true,
      ),
      'sidebar_widget_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Widget Background Alpha',
        'description' => 'For Sidebar Widgets.',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
    );

  }

} // end class

new GSC_Widget_Styles;
