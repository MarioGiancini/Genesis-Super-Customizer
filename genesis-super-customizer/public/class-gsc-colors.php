<?php

/**
* Register colors customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
* @subpackage Genesis_Super_Customizer/includes
*/

class GSC_Colors extends GSC_Base {

  protected $mod_section = 'colors';

  protected $new_section = false;

  //* Setup mods here to get for output.
  protected function get_mods() {

    $this->mod_settings = array(
      'theme_main_color' => array(
        'css'         => array( 'a, .site-title a, .genesis-nav-menu a:hover, .nav-primary .genesis-nav-menu a:hover, .nav-primary .genesis-nav-menu .current-menu-item > a, .genesis-nav-menu .current-menu-item > a, .nav-primary .genesis-nav-menu .sub-menu .current-menu-item > a:hover, .genesis-nav-menu .sub-menu .current-menu-item > a:hover, .entry-title a:hover, .theme-color', 'color', '', '', true, array(
          'siblings' => array( '.theme-bg' => 'background-color', '.enews-widget input[type="submit"], button:hover, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover' => 'background-color', '.archive-pagination li a:hover, .archive-pagination .active a' => 'background-color' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#e5554e',
        'description' => 'Will be set to site header text color, links color, post title hover color, button color, and header nav hover color.',
        'option'      => true,
      ),
      'theme_accent_color' => array(
        'css'         => array( 'a:hover, .site-title a:hover, .entry-title a, .accent-color', 'color', '', '', true, array(
          'siblings' => array( '.accent-bg' => 'background-color', '.nav-primary' => 'background-color', '.sidebar .widget.enews-widget' => 'background-color', '.footer-widgets' => 'background-color', 'button, input[type="button"], input[type="reset"], input[type="submit"], .button' => 'background-color', 'input:focus, textarea:focus' => 'border-color', '::-webkit-input-placeholder' => 'color', ':-moz-placeholder' => 'color', '::-moz-placeholder' => 'color', ':-ms-input-placeholder' => 'color' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'description' => 'Will be set to links hover color, post title color, placeholder color, input focus border, primary nav background, and footer widgets background.',
        'option'      => true,
      ),
      'bg_color' => array(
        'css'         => array( 'body, .main-bg', 'background-color', '', '', true, array( 'siblings' => array( '.bg-color' => 'color' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '',
        'label'       => 'Background Color',
        'option'      => true,
      ),
      'header_background_color' => array(
        'css'         => array( '.site-header', 'background-color', '', '', true, array( 'rgba' => 'header_background_alpha' ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#fff',
        'option'      => true,
      ),
      'header_background_alpha' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'range',
        'default'     => 100,
        'label'       => 'Header Background Alpha',
        'input_attrs' => array(
          'min'   => 0,
          'max'   => 100,
          'step'  => 5,
        ),
        'decimal'     => true,
        'option'      => true,
      ),
      'body_text_color' => array(
        'css'         => array( 'body', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'option'      => true,
      ),
      'heading_text_color' => array(
        'css'         => array( 'h1, h2, h3, h4, h5, h6', 'color' ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'description' => 'For heading tags h1 through h6.',
        'option'      => true,
      ),
      'link_decoration' => array(
        'css'         => array( 'a, .nav-primary .genesis-nav-menu a:hover, .nav-primary .genesis-nav-menu a:focus, .nav-primary .genesis-nav-menu .current-menu-item > a', 'text-decoration' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'None',
        'choices'     => $this->decorations,
        'option'      => true,
      ),
      'link_hover_decoration' => array(
        'css'         => array( 'a:hover, a:focus, .genesis-nav-menu a:hover, .genesis-nav-menu a:focus, .genesis-nav-menu .current-menu-item > a, .genesis-nav-menu .sub-menu .current-menu-item > a:hover, .genesis-nav-menu .sub-menu .current-menu-item > a:focus', 'text-decoration' ),
        'priority'    => 10,
        'type'        => 'select',
        'default'     => 'None',
        'description' => 'Text decoration for link hover and focus.',
        'choices'     => $this->decorations,
        'option'      => true,
      ),
      'override_link_colors' => array(
        'css'         => array(),
        'priority'    => 10,
        'type'        => 'checkbox',
        'default'     => 0,
        'description' => 'Check to override the theme color defaults for links. Options will appear below.',
        'option'      => true,
      ),
      'link_text_color' => array(
        'css'         => array( 'a', 'color', '', '', true, array( 'requires' => array( 'override_link_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#e5554e',
        'option'      => true,
      ),
      'link_hover_color' => array(
        'css'         => array( 'a:hover', 'color', '', '', true, array( 'requires' => array( 'override_link_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'option'      => true,
      ),
      'post_title_text_color' => array(
        'css'         => array( '.entry-title a', 'color', '', '', true, array( 'requires' => array( 'override_link_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#333',
        'option'      => true,
      ),
      'post_title_hover_color' => array(
        'css'         => array( '.entry-title a:hover', 'color', '', '', true, array( 'requires' => array( 'override_link_colors' ) ) ),
        'priority'    => 10,
        'type'        => 'color',
        'default'     => '#e5554e',
        'option'      => true,
      )
    );

  }

  /**
  * Filter specific controls to show within content
  */
  public function active_filter( $active, $control ) {

    //* Show color override options if override is checked
    if ( $control->id === 'link_text_color' || $control->id === 'link_hover_color' || $control->id === 'post_title_text_color' || $control->id === 'post_title_hover_color' ) {
      $option = $control->manager->get_setting( $this->get_field_name( 'override_link_colors' ) );
      $active = $option->value();
    }

    return $active;
  }

} // end class

new GSC_Colors;
