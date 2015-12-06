<?php
/**
* Register the base class for customizer settings
*
* @link       http://genesissupercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
*/

abstract class GSC_Base {

  /**
  * The default Customizer Settings field. Change to 'genesis-settings' per class
  * if needing to add to the Genesis Settings field instead.
  *
  */
  protected $settings_field = 'genesis-customizer-settings';

  /**
  * Variables defined per inherited classes
  */
  protected $new_section = true;

  protected $mod_section = '';

  protected $section_title = '';

  protected $section_desc = '';

  protected $section_priority = 100;

  protected $new_panel = false;

  protected $mod_panel = '';

  protected $panel_title = '';

  protected $panel_desc = '';

  protected $panel_priority = 100;

  protected $active_callback = '';

  protected $mod_settings = array();

  public static $media_queries = array();

  public static $default_settings = array();

  public static $default_settings_field = 'genesis-customizer-settings';

  public static $default_genesis_settings = array();

  //* For use in media queries
  public $mobile_max_size = 960;

  public $desktop_min_size = 961;

  //* Fonts options to add to certain settings
  public $fonts = array(
    'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
    '"Arial Black", Gadget, sans-serif' => 'Arial Black, Gadget, sans-serif',
    '"Arial Narrow", Gadget, sans-serif' => 'Arial Narrow, Gadget, sans-serif',
    '"Comic Sans MS", cursive, sans-serif' => 'Comic Sans MS, cursive, sans-serif',
    'cursive, sans-serif' => 'cursive, sans-serif',
    '"Courier New", Courier, monospace' => 'Courier New, Courier, monospace',
    'Georgia, serif' => 'Georgia, serif',
    'Helvetica, sans-serif' => 'Helvetica, sans-serif',
    'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
    'Lato, sans-serif' => 'Lato, sans-serif',
    '"Lucida Console", Monaco, monospace' => 'Lucida Console, Monaco, monospace',
    '"Lucida Sans Unicode", "Lucida Grande", sans-serif' => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
    '"Open Sans", sans-serif' => 'Open Sans, sans-serif',
    '"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
    'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
    '"Times New Roman", Times, serif' => 'Times New Roman, Times, serif',
    '"Trebuchet MS", Helvetica, sans-serif' => 'Trebuchet MS, Helvetica, sans-serif',
    'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif'
  );

  //* Text transform styles
  public $caps_options = array(
    'none'        => ' - None - ',
    'uppercase'   => 'UPPERCASE',
    'lowercase'   => 'lowercase',
    'capitalize'  => 'Capitalize Word'
  );

  //* Text alignment options
  public $alignments = array(
    'left'  => 'Left',
    'right' => 'Right',
    'center'=> 'Center'
  );

  //* Text alignment options
  public $decorations = array(
    'initial'     => 'None',
    'underline'   => 'Underline',
    'line-through'=> 'Line-through',
    'overline'    => 'Overline'
  );

  public $border_styles = array(
    'dashed'  => 'Dashed',
    'dotted'  => 'Dotted',
    'double'  => 'Double',
    'groove'  => 'Groove',
    'inset'   => 'Inset',
    'solid'   => 'Solid',
    'none'    => 'None',
  );

  public function __construct() {

    //* Register Customizer option to defaults array
    add_action( 'init', array( $this, 'add_gsc_options')  );

    //* Register Customizer settings
    add_action( 'customize_register', array( $this, 'register'), 15 );

    //* Output CSS to WP_Head
    add_action( 'wp_head', array( $this, 'super_customizer_output' ) );

    //* Customizer scripts
    if ( method_exists( $this, 'scripts' ) ) {
      add_action( 'customize_preview_init', array( $this, 'scripts' ) );
    }

    //* Customizer Active Callback Filter
    if ( method_exists( $this, 'active_filter' ) ) {
      add_filter( 'customize_control_active', array( $this, 'active_filter' ), 10, 2 );
    }

    //* Set method in media queries class
    if  ( method_exists( $this, 'do_media_queries' ) ) {
      add_action( 'wp_head', array( $this, 'do_media_queries' ) );
    }

  }

  /**
  * From Genesis options
  */
  protected function get_field_name( $name ) {
    return sprintf( '%s[%s]', $this->settings_field, $name );
  }

  /**
  * From Genesis options
  */
  protected function get_field_value( $key ) {
    if( function_exists( 'genesis_get_option' ) ) {
      return genesis_get_option( $key, $this->settings_field );
    }
  }

  /**
  * Defined per inherited classes
  */
  protected function get_mods() {

    // Redefine in child class and set mods to $this->mod_settings

  }

  /**
  * Set customizer mods to default settings.
  *
  * @since    1.0.0
  */
  public function add_gsc_options() {

    $this->get_mods();

    if( !empty( $this->mod_settings ) ) {

      //* If it's not being added to genesis-settings add $mod to customizer default settings
      if( $this->settings_field !== 'genesis-settings' ) {
        foreach( $this->mod_settings as $mod => $settings ) {
          self::$default_settings[$mod] = $settings['default'];
        }
      }

      //* Options defaults to add to genesis settings
      if( $this->settings_field === 'genesis-settings' ) {
        foreach( $this->mod_settings as $mod => $settings ) {
          self::$default_genesis_settings[$mod] = $settings['default'];
        }
      }

    }

  }

  /**
  * Register desfault settings option.
  *
  * @since    1.0.0
  */
  static public function gsc_register_defaults() {

    add_option( self::$default_settings_field, self::$default_settings );

  }

  /**
  * Set up new mod settings and controls by name then array of params and
  * assign to a section via $mod_section
  *
  * @uses $wp_customize
  *
  * $mod_args params
  * @param array['priority'] int -> $priority
  * @param array['type'] string -> $type
  * @param array['default'] any -> $default or array for select $choices
  * @param array['label'] string -> $label
  * @param array['description'] string -> $description
  * @param array['choices'] array -> $choices (for select and radio type only)
  * @param array['input_attrs'] array -> $input_attrs Customizer attributes min, max, step, class active_callback
  * @param array['active_callback'] string -> $active_callback function
  *
  * @since 1.0.0
  */
  public function register( $wp_customize ) {

    $this->get_mods();

    if( $this->new_panel === true ) {
      $wp_customize->add_panel( $this->mod_panel, array(
        'title'           => __( $this->panel_title, 'genesis' ),
        'description'     => __( $this->panel_desc, 'genesis' ),
        'priority'        => $this->panel_priority,
        'active_callback' => $this->active_callback
        )
      );
    }

    if( $this->new_section === true ) {
      $wp_customize->add_section(
        $this->mod_section,
        array(
          'title'           => __( $this->section_title, 'genesis' ),
          'description'     => __( $this->section_desc, 'genesis' ),
          'priority'        => $this->section_priority,
          'panel'           => $this->mod_panel,
          'active_callback' => $this->active_callback
        )
      );
    }

    if( !empty( $this->mod_settings ) ) {

      foreach( $this->mod_settings as $mod => $settings ) {

        $label = '';
        $setting = '';

        $desc = $settings['description'];

        //* Check for custom label or use setting name
        if( $settings['label'] ) {
          $label = $settings['label'];
        } else {
          $label = ucwords( str_replace( '_', ' ', $mod ) );
        }

        //* Check if set as an option or theme mod
        $option = $settings['option'] === true ? 'option' : 'theme_mod';
        if ( $settings['option'] === true ) {
          $setting = $this->get_field_name( $mod );
        } else {
          $setting = $mod;
        }

        //* Add the customizer setting
        $wp_customize->add_setting(
          $setting,
          array(
            'default' => $settings['default'],
            'type'    => $option
          )
        );

        //* Add if select or radio control
        if( $settings['type'] === 'select' || $settings['type'] === 'radio' ) {

          $wp_customize->add_control(
            $mod,
            array(
              'label'           => __( $label, 'genesis' ),
              'description'     => __( $desc, 'genesis' ),
              'section'         => $this->mod_section,
              'settings'        => $setting,
              'type'            => $settings['type'],
              'choices'         => $settings['choices'],
              'priority'        => $settings['priority'],
              'active_callback' => $settings['active_callback']
            )
          );
        }

        //* Add if color control
        elseif( $settings['type'] === 'color' ) {

          $wp_customize->add_control(
            new WP_Customize_Color_Control(
              $wp_customize,
              $mod,
              array(
                'section'         => $this->mod_section,
                'label'           => __( ucwords( str_replace( '_', ' ', $label ) ), 'genesis' ),
                'description'     => __( $desc, 'genesis' ),
                'settings'        => $setting,
                'priority'        => $settings['priority'],
                'active_callback' => $settings['active_callback']
              )
            )
          );
        }

        //* Add if image control
        elseif( $settings['type'] === 'image' ) {

          $wp_customize->add_control(
            new WP_Customize_Image_Control(
              $wp_customize,
              $mod,
              array(
                'section'         => $this->mod_section,
                'label'           => __( $label, 'genesis' ),
                'description'     => __( $desc, 'genesis' ),
                'settings'        => $setting,
                'priority'        => $settings['priority'],
                'active_callback' => $settings['active_callback']
             )
            )
          );
        }

        //* Add if custom range control
        elseif( $settings['type'] === 'range' ) {

          $wp_customize->add_control(
            new Customize_Range_Control(
              $wp_customize,
              $mod,
              array(
                'label'           => __( $label, 'genesis' ),
                'description'     => __( $desc, 'genesis' ),
                'section'         => $this->mod_section,
                'settings'        => $setting,
                'priority'        => $settings['priority'],
                'input_attrs'     => $settings['input_attrs'],
                'postfix'         => $settings['decimal'] === true ? '%' : $settings['css'][3],
                'active_callback' => $settings['active_callback']
              )
            )
          );
        }

        //* Add if a normal control
        else {

          $wp_customize->add_control(
            $mod,
            array(
              'label'           => __( $label, 'genesis' ),
              'description'     => __( $desc, 'genesis' ),
              'section'         => $this->mod_section,
              'settings'        => $setting,
              'type'            => $settings['type'],
              'priority'        => $settings['priority'],
              'input_attrs'     => $settings['input_attrs'],
              'active_callback' => $settings['active_callback']
            )
          );
        }

      } // foreach
    } // end if
  }

  /**
  * This will output the custom WordPress settings to the live theme's WP head.
  *
  * @uses generate_customizer_css()
  *
  * @see add_action('wp_head',$func)
  *
  * @since 1.0.0
  */
  public function super_customizer_output() {

    // get the mod settings first
    $this->get_mods();

    if( !empty( $this->mod_settings ) ) {

    ?>
    <style type="text/css" id="gsc_<?php echo $this->mod_section; ?>">
    <?php

    echo "\r\n"; // start with a new line
    echo '/*** ' . ucwords( str_replace( '_', ' ', $this->mod_section ) ) . ' ***/';
    echo "\r\n";

    foreach( $this->mod_settings as $mod => $settings ) {

      //* Render CSS rules is a selector is given
      if ( $settings['css'][0] ) {
        $mod_name = $mod;
        $option_type = $settings['option'] === true ? true : false; // check if mod is a genesis option
        $selector = $settings['css'][0];
        $styles = $settings['css'][1];
        $prefix = $settings['css'][2];
        $postfix = $settings['css'][3];
        $echo = ( $settings['css'][3] ? $settings['css'][3] : true ); // check if echo option is set
        $dependancies = $settings['css'][5];

        $this->generate_customizer_css( $mod_name, $option_type, $selector, $styles, $prefix, $postfix, $echo, $dependancies );

      }
    }

    echo "\r\n";

    ?>

    </style>

    <?php
    }

  }

  /**
  * This will generate a line of CSS for use in header output. If the setting
  * ($mod_name) has no defined value, the CSS will not be output.
  *
  * @uses get_theme_mod()
  * @param string $mod_name The name of the 'theme_mod' option to fetch
  * @param bool $option_type Whether to use get_them_mod() or use genesis_get_option() via get_field_value()
  * @param string $selector CSS selector
  * @param string $styles The name(s) of the CSS *property* to modify
  * @param string $prefix Optional. Anything that needs to be output before the CSS property
  * @param string $postfix Optional. Anything that needs to be output after the CSS property
  * @param bool $echo Optional. Whether to print directly to the page (default: true).
  * @param array $dependancies Optional. Any dependancy required to activate CSS property
  * @return string Returns a single line of CSS with selectors and a property.
  * @since 1.0.0
  */
  public function generate_customizer_css( $mod_name, $option_type=false, $selector, $styles, $prefix='', $postfix='', $echo=true, $dependancies=array() ) {
    $return = "";

    $mod = "";

    //* Check if its a Genesis option or theme mod
    if( $option_type === true ) {
      $mod = $this->get_field_value( $mod_name );
    }

    else {
      $mod = get_theme_mod( $mod_name );
    }

    //* Check to see if mod value exceeds max value
    if( $this->mod_settings[$mod_name]['input_attrs']['max'] && $mod > $this->mod_settings[$mod_name]['input_attrs']['max'] ) {

      $mod = $this->mod_settings[$mod_name]['input_attrs']['max'];

      //* Update genesis option with max value;
      if( $option_type === true ) {

        $geneses_options = get_option( $this->settings_field );
        $geneses_options[ $mod_name ] = $mod;
        update_option( $this->settings_field, $geneses_options);

      }

    }

    //* Check to see if mod value exceeds min value
    if( $this->mod_settings[$mod_name]['input_attrs']['min'] && $mod < $this->mod_settings[$mod_name]['input_attrs']['min'] ) {

      $mod = $this->mod_settings[$mod_name]['input_attrs']['min'];

      //* Update genesis option with min value;
      if( $option_type === true ) {

        $geneses_options = get_option( $this->settings_field );
        $geneses_options[ $mod_name ] = $mod;
        update_option( $this->settings_field, $geneses_options);

      }

    }

    // Get all properties for this CSS line
    $properties = explode( ' ', $styles );

    //* By default won't fire CSS if value is unset or checkboxes unchecked or if uses a media query.
    if( isset( $mod ) ) {

      if( empty( $mod ) && $this->mod_settings[$mod_name]['type'] === 'checkbox' ) {
        return $return;
      }

      //* check for requirements and return nothing if not met.
      if( $dependancies['requires'] ) {
        foreach( $dependancies['requires'] as $requirement ) {

          if( $this->mod_settings[$requirement]['option'] === true ) {

            if( ! $this->get_field_value( $requirement ) ) {
              echo "/****** Option " . $requirement . " requirement not met! ******/";
              return $return;
            }

          } elseif( ! get_theme_mod( $requirement ) ) {
            echo "/****** Theme Mod " . $requirement . " requirement not met! ******/";
            return $return;
          }
        }
      }

      if( isset( $dependancies['value'] ) ) {
        $mod = $dependancies['value'];
      }

      if( $this->mod_settings[$mod_name]['decimal'] ) {
        $mod = $mod / 100;
      }

      if( $dependancies['rgba'] && ! empty( $mod ) ) {
        $rgba = $dependancies['rgba'];
        $alpha = 1;
        //* Get the alpha value from genesis option or theme mod
        if( $this->mod_settings[$rgba]['option'] === true ) {
          $alpha = $this->mod_settings[$rgba]['decimal'] ? $this->get_field_value( $rgba ) / 100 : $this->get_field_value( $rgba );
        } else {
          $alpha = $this->mod_settings[$rgba]['decimal'] ? get_theme_mod( $rgba ) / 100 : get_theme_mod( $rgba );
        }
        //* Use rgba converter function
        $mod = hex2rgba( $mod, $alpha );
      }

      //* CSS selector and open curly brace
      $return = $selector . " { ";

      //* Allow for multiple properties to be assigned the same value i.e. padding-top and padding-bottom
      foreach( $properties as $property ) {
        $return .= $property . ": " . $prefix.$mod.$postfix . "; ";
      }

      //* Add other manditory properties
      if( $dependancies['uses'] ) {
        foreach( $dependancies['uses'] as $add_property => $add_value ) {
          $return .= $add_property . ": " . $add_value . "; ";
        }
      }

      //* close curly brace and add new line
      $return .= " }\r\n";

      //* Add other selecors with same mod value but different property
      if( $dependancies['siblings'] ) {
        foreach( $dependancies['siblings'] as $sibling_selector => $sibling_property ) {
          $return .= $sibling_selector . " { " . $sibling_property . ": " . $mod . ";  }\r\n";
        }
      }

      //* Check dependancies for other affected properties
      if( $dependancies['affects'] ) {

        foreach( $dependancies['affects'] as $affect_selector ) {

          $method = "";
          $method_close = "";
          $affect_properties = "";

          if ( $dependancies['affects_values'][$affect_selector] ) {

            $return .= $affect_selector . " { ";

            $return .= $dependancies['affects_values'][$affect_selector];

            $return .= " }\r\n";

          }

          if ( $dependancies['affects_factors'][$affect_selector] ) {

            $factor_property = key( $dependancies['affects_factors'][$affect_selector] );
            $affects_factor = current( $dependancies['affects_factors'][$affect_selector] );
            $affects_value = $mod * $affects_factor;

            $return .= $affect_selector . " { ";

            $return .= $factor_property . ": " . $prefix.$affects_value.$postfix . "; ";

            $return .= " }\r\n";

          }

          if ( $dependancies['affects_percentages'][$affect_selector] ) {

            $percent_numerator = key( $dependancies['affects_percentages'][$affect_selector] );
            $percent_denominator = current( $dependancies['affects_percentages'][$affect_selector] );
            $affects_percent = $this->get_field_value( $percent_numerator ) / $this->get_field_value( $percent_denominator );

            $return .= $affect_selector . " { ";

            foreach( $affect_properties as $single_property ) {
              $return .= $single_property . ": " . $method.$affects_percent.$method_close . "; ";
            }

            $return .= " }\r\n";

            next( $dependancies['affects_percentages'] );
          }

        }
      }

      //* $echo is true and there are no media queries for this mod, echo it out
      if( $echo && ! $dependancies['media_query'] ) {

        echo $return;

      }

      //* If there are media queries add them to static query array
      if( $dependancies['media_query'] ) {

        $media_query = $dependancies['media_query'];

        self::$media_queries[$media_query] .= $return;

      }

    } // end if( $mod )

    return $return;
  }

} // end class
