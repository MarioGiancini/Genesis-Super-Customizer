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

	public static $preview_settings = array();

	//* Setting to use options (by default) or theme mods
	public $use_option = true;

	//* Some sections may not output css
	protected $no_css = false;

	//* For use in media queries
	public $mobile_max_size = 960;

	public $desktop_min_size = 961;

	//* Fonts options to add to certain settings
	public $fonts = array(
		'Arial, Helvetica, sans-serif'                         => 'Arial, Helvetica, sans-serif',
		'"Arial Black", Gadget, sans-serif'                    => 'Arial Black, Gadget, sans-serif',
		'"Arial Narrow", Gadget, sans-serif'                   => 'Arial Narrow, Gadget, sans-serif',
		'"Comic Sans MS", cursive, sans-serif'                 => 'Comic Sans MS, cursive, sans-serif',
		'cursive, sans-serif'                                  => 'cursive, sans-serif',
		'"Courier New", Courier, monospace'                    => 'Courier New, Courier, monospace',
		'Georgia, serif'                                       => 'Georgia, serif',
		'Helvetica, sans-serif'                                => 'Helvetica, sans-serif',
		'Impact, Charcoal, sans-serif'                         => 'Impact, Charcoal, sans-serif',
		'Lato, sans-serif'                                     => 'Lato, sans-serif',
		'"Lucida Console", Monaco, monospace'                  => 'Lucida Console, Monaco, monospace',
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif'   => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
		'"Open Sans", sans-serif'                              => 'Open Sans, sans-serif',
		'"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
		'Tahoma, Geneva, sans-serif'                           => 'Tahoma, Geneva, sans-serif',
		'"Times New Roman", Times, serif'                      => 'Times New Roman, Times, serif',
		'"Trebuchet MS", Helvetica, sans-serif'                => 'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif'                          => 'Verdana, Geneva, sans-serif'
	);

	//* Text transform styles
	public $caps_options = array(
		'none'       => ' - None - ',
		'uppercase'  => 'UPPERCASE',
		'lowercase'  => 'lowercase',
		'capitalize' => 'Capitalize Word'
	);

	//* Text alignment options
	public $alignments = array(
		'left'   => 'Left',
		'right'  => 'Right',
		'center' => 'Center'
	);

	//* Text alignment options
	public $decorations = array(
		'initial'      => 'None',
		'underline'    => 'Underline',
		'line-through' => 'Line-through',
		'overline'     => 'Overline'
	);

	public $border_styles = array(
		'dashed' => 'Dashed',
		'dotted' => 'Dotted',
		'double' => 'Double',
		'groove' => 'Groove',
		'inset'  => 'Inset',
		'solid'  => 'Solid',
		'none'   => 'None',
	);

	public function __construct() {

		//* Register Customizer option to defaults array
		add_action( 'init', array( $this, 'add_gsc_options' ) );

		//* Register Customizer settings
		add_action( 'customize_register', array( $this, 'register' ), 15 );

		//* Output CSS to WP_Head
		add_action( 'wp_head', array( $this, 'super_customizer_output' ) );

		//* Customizer scripts
		if ( method_exists( $this, 'scripts' ) ) {
			add_action( 'customize_preview_init', array( $this, 'scripts' ) );
		}

		//* Set method in media queries class
		if ( method_exists( $this, 'do_media_queries' ) ) {
			add_action( 'wp_head', array( $this, 'do_media_queries' ) );
		}

	}

	/**
	 * From Genesis options
	 *
	 * @param $name
	 *
	 * @return string
	 */
	protected function get_field_name( $name ) {
		return sprintf( '%s[%s]', $this->settings_field, $name );
	}

	/**
	 * Derived from Genesis options
	 *
	 * @param string $key
	 *
	 * @param string|bool $option
	 *
	 * @return mixed
	 */
	protected function get_field_value( $key, $option = '') {
		// Allow getting settings from theme mods if that's setup, with ability to dictate
		// when certain fields may always be an option by setting to true.
		$option = $option === '' ? $this->use_option : $option;
		if ( function_exists( 'genesis_get_option' ) && $option) {
			return genesis_get_option( $key, $this->settings_field );
		} else if ($option === false) {
			return get_theme_mod($key);
		} else {
			return false;
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

		$gsc_options = get_option( self::$default_settings_field );

		$gsc_use_options = !array_key_exists( 'gsc_use_options', $gsc_options ) ? true : $gsc_options['gsc_use_options'];

		$this->use_option = $gsc_use_options ? true : false;

		if ( ! empty( $this->mod_settings ) ) {

			//* If it's not being added to genesis-settings add $mod to customizer default settings
			if ( $this->settings_field !== 'genesis-settings' ) {
				foreach ( $this->mod_settings as $mod => $settings ) {
					self::$default_settings[ $mod ] = $settings['default'];

					// Add each of the settings that have Live Preview to static array
					if (array_key_exists('transport', $settings) && $settings['transport'] === 'postMessage') {
						self::$preview_settings[$mod] = [
							'selector' => $settings['css'][0],
							'styles' => explode( ' ', $settings['css'][1] ), // can be multiple
							'prefix' => $settings['css'][2] ? $settings['css'][2] : '',
							'postfix' => $settings['css'][3] ? $settings['css'][3] : '',
							'siblings' => $settings['css'][5] && array_key_exists('siblings', $settings['css'][5]) ? $settings['css'][5]['siblings'] : array()
						];
					}
				}
			}

			//* Options defaults to add to genesis settings
			if ( $this->settings_field === 'genesis-settings' ) {
				foreach ( $this->mod_settings as $mod => $settings ) {
					self::$default_genesis_settings[ $mod ] = $settings['default'];
				}
			}

		}

	}

	/**
	 * Register default settings option.
	 *
	 * @since    1.0.0
	 */
	static public function gsc_register_defaults() {

		add_option( self::$default_settings_field, self::$default_settings );

	}

	/**
	 * Reset default settings option from reset button in Customizer
	 *
	 * @since    1.1.0
	 */
	static public function gsc_reset_defaults() {

		update_option( self::$default_settings_field, self::$default_settings );

	}

	/**
	 * Set up new mod settings and controls by name then array of params and
	 * assign to a section via $mod_section
	 *
	 * @uses $wp_customize
	 *
	 * $mod_args params
	 *
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

		if ( $this->new_panel ) {
			$wp_customize->add_panel( $this->mod_panel, array(
					'title'           => __( $this->panel_title, 'genesis-super-customizer' ),
					'description'     => __( $this->panel_desc, 'genesis-super-customizer' ),
					'priority'        => $this->panel_priority,
					'active_callback' => $this->active_callback
				)
			);
		}

		if ( $this->new_section ) {
			$wp_customize->add_section(
				$this->mod_section,
				array(
					'title'           => __( $this->section_title, 'genesis-super-customizer' ),
					'description'     => __( $this->section_desc, 'genesis-super-customizer' ),
					'priority'        => $this->section_priority,
					'panel'           => $this->mod_panel,
					'active_callback' => $this->active_callback
				)
			);
		}

		if ( ! empty( $this->mod_settings ) ) {

			foreach ( $this->mod_settings as $mod => $settings ) {


				//* Verify settings exist in array or set defaults
				$label           = array_key_exists( 'label', $settings ) ? $settings['label'] : ucwords( str_replace( '_', ' ', $mod ) );
				$option          = array_key_exists( 'option', $settings ) && $settings['option'] ? 'option' : 'theme_mod';
				$setting         = $option === 'option' ? $this->get_field_name( $mod ) : $mod;
				$type            = array_key_exists( 'type', $settings ) ? $settings['type'] : '';
				$priority        = array_key_exists( 'priority', $settings ) ? $settings['priority'] : '';
				$input_attrs     = array_key_exists( 'input_attrs', $settings ) ? $settings['input_attrs'] : array();
				$active_callback = array_key_exists( 'active_callback', $settings ) ? $settings['active_callback'] : '';
				$desc            = array_key_exists( 'description', $settings ) ? $settings['description'] : '';
				$transport       = array_key_exists( 'transport', $settings ) && !$this->use_option ? $settings['transport'] : 'refresh';

				//* Add the customizer setting
				$wp_customize->add_setting(
					$setting,
					array(
						'default'   => $settings['default'],
						'type'      => $option,
						'transport' => $transport
					)
				);

				//* Add if select or radio control
				if ( $type === 'select' || $type === 'radio' ) {

					$wp_customize->add_control(
						$mod,
						array(
							'label'           => __( $label, 'genesis-super-customizer' ),
							'description'     => __( $desc, 'genesis-super-customizer' ),
							'section'         => $this->mod_section,
							'settings'        => $setting,
							'type'            => $type,
							'choices'         => array_key_exists( 'choices', $settings ) ? $settings['choices'] : array(),
							'priority'        => $priority,
							'active_callback' => $active_callback
						)
					);
				} //* Add if color control
				elseif ( $type === 'color' ) {

					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							$mod,
							array(
								'section'         => $this->mod_section,
								'label'           => __( ucwords( str_replace( '_', ' ', $label ) ), 'genesis-super-customizer' ),
								'description'     => __( $desc, 'genesis-super-customizer' ),
								'settings'        => $setting,
								'priority'        => $priority,
								'active_callback' => $active_callback
							)
						)
					);
				} //* Add if image control
				elseif ( $type === 'image' ) {

					$wp_customize->add_control(
						new WP_Customize_Image_Control(
							$wp_customize,
							$mod,
							array(
								'section'         => $this->mod_section,
								'label'           => __( $label, 'genesis-super-customizer' ),
								'description'     => __( $desc, 'genesis-super-customizer' ),
								'settings'        => $setting,
								'priority'        => $priority,
								'active_callback' => $active_callback
							)
						)
					);
				} //* Add if custom range control
				elseif ( $type === 'range' ) {

					$wp_customize->add_control(
						new Customize_Range_Control(
							$wp_customize,
							$mod,
							array(
								'label'           => __( $label, 'genesis-super-customizer' ),
								'description'     => __( $desc, 'genesis-super-customizer' ),
								'section'         => $this->mod_section,
								'settings'        => $setting,
								'priority'        => $priority,
								'input_attrs'     => $input_attrs,
								'postfix'         => array_key_exists( 'decimal', $settings ) && $settings['decimal'] ? '%' : $settings['css'][3],
								'active_callback' => $active_callback
							)
						)
					);
				} //* Add if a normal control
				else {

					$wp_customize->add_control(
						$mod,
						array(
							'label'           => __( $label, 'genesis-super-customizer' ),
							'description'     => __( $desc, 'genesis-super-customizer' ),
							'section'         => $this->mod_section,
							'settings'        => $setting,
							'type'            => $type,
							'priority'        => $priority,
							'input_attrs'     => $input_attrs,
							'active_callback' => $active_callback
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
	 * @see  add_action('wp_head',$func)
	 *
	 * @since 1.0.0
	 */
	public function super_customizer_output() {

		// get the mod settings first
		$this->get_mods();

		if ( !empty( $this->mod_settings ) && !$this->no_css ) {

			?>
			<style type="text/css" id="gsc_<?php echo $this->mod_section; ?>">
				<?php
				echo '/*** ' . ucwords( str_replace( '_', ' ', $this->mod_section ) ) . ' ***/';
				echo "\r\n";

				foreach( $this->mod_settings as $mod => $settings ) {

					//* Render CSS rules if a selector is given
					if ( $settings['css'][0] ) {
						$mod_name = $mod;
						$option_type = $settings['option'] === true ? true : false; // check if mod is a genesis option
						$selector = $settings['css'][0];
						$styles = $settings['css'][1];
						$prefix = $settings['css'][2];
						$postfix = $settings['css'][3];
						$echo = ( $settings['css'][4] === false ? $settings['css'][4] : true ); // check if echo option is set
						$dependencies = $settings['css'][5];

						$this->generate_customizer_css( $mod_name, $option_type, $selector, $styles, $prefix, $postfix, $echo, $dependencies );
					}
				}

//				echo "\r\n";

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
	 *
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param bool $option_type Whether to use get_them_mod() or use genesis_get_option() via get_field_value()
	 * @param string $selector CSS selector
	 * @param string $styles The name(s) of the CSS *property* to modify
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool $echo Optional. Whether to print directly to the page (default: true).
	 * @param array $dependencies Optional. Any dependency required to activate CSS property
	 *
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since 1.0.0
	 */
	public function generate_customizer_css( $mod_name, $option_type = false, $selector, $styles, $prefix = '', $postfix = '', $echo = true, $dependencies = array() ) {
		$return = "";

		//* Check if its a Genesis option or theme mod
		if ( $option_type === true ) {
			$mod = $this->get_field_value( $mod_name );
		} else {
			$mod = get_theme_mod( $mod_name );
		}


		//* By default won't fire CSS if value is unset or checkboxes unchecked or if uses a media query.
		if ( isset( $mod ) && $mod !== '' && $mod !== null ) { // not null?
			//* Check to see if mod value exceeds max value
			if ( array_key_exists( 'input_attrs', $this->mod_settings[ $mod_name ] ) && $this->mod_settings[ $mod_name ]['input_attrs']['max'] && $mod > $this->mod_settings[ $mod_name ]['input_attrs']['max'] ) {

				$mod = $this->mod_settings[ $mod_name ]['input_attrs']['max'];

				//* Update genesis option with max value;
				if ( $option_type === true ) {

					$genesis_options              = get_option( $this->settings_field );
					$genesis_options[ $mod_name ] = $mod;
					update_option( $this->settings_field, $genesis_options );

				}

			}

			//* Check to see if mod value exceeds min value
			if ( array_key_exists( 'input_attrs', $this->mod_settings[ $mod_name ] ) && $this->mod_settings[ $mod_name ]['input_attrs']['min'] && $mod < $this->mod_settings[ $mod_name ]['input_attrs']['min'] ) {

				$mod = $this->mod_settings[ $mod_name ]['input_attrs']['min'];

				//* Update genesis option with min value;
				if ( $option_type === true ) {

					$genesis_options              = get_option( $this->settings_field );
					$genesis_options[ $mod_name ] = $mod;
					update_option( $this->settings_field, $genesis_options );

				}

			}

			// Get all properties for this CSS line
			$properties = explode( ' ', $styles );

			if ( empty( $mod ) && $this->mod_settings[ $mod_name ]['type'] === 'checkbox' ) {
				return $return;
			}

			//* check for requirements and return nothing if not met.
			if ( $dependencies['requires'] ) {
				foreach ( $dependencies['requires'] as $requirement ) {

					if ( $this->mod_settings[ $requirement ]['option'] === true ) {

						if ( ! $this->get_field_value( $requirement ) ) {
							echo "/****** Option " . $requirement . " requirement not met! ******/";

							return $return;
						}

					} elseif ( ! get_theme_mod( $requirement ) ) {
						echo "/****** Theme Mod " . $requirement . " requirement not met! ******/";

						return $return;
					}
				}
			}

			if ( isset( $dependencies['value'] ) ) {
				$mod = $dependencies['value'];
			}

			if ( $this->mod_settings[ $mod_name ]['decimal'] ) {
				$mod = $mod / 100;
			}

			if ( $dependencies['rgba'] && ! empty( $mod ) ) {
				$rgba = $dependencies['rgba'];
				//* Get the alpha value from genesis option or theme mod
				if ( $this->mod_settings[ $rgba ]['option'] === true ) {
					$alpha = $this->mod_settings[ $rgba ]['decimal'] ? $this->get_field_value( $rgba ) / 100 : $this->get_field_value( $rgba );
				} else {
					$alpha = $this->mod_settings[ $rgba ]['decimal'] ? get_theme_mod( $rgba ) / 100 : get_theme_mod( $rgba );
				}
				//* Use rgba converter function
				$mod = hex2rgba( $mod, $alpha );
			}

			//* CSS selector and open curly brace
			$return = $selector . " { ";

			//* Allow for multiple properties to be assigned the same value i.e. padding-top and padding-bottom
			foreach ( $properties as $property ) {
				$return .= $property . ": " . $prefix . $mod . $postfix . "; ";
			}

			//* Add other mandatory properties
			if ( $dependencies['uses'] ) {
				foreach ( $dependencies['uses'] as $add_property => $add_value ) {
					$return .= $add_property . ": " . $add_value . "; ";
				}
			}

			//* close curly brace and add new line
			$return .= " }\r\n";

			//* Add other selectors with same mod value but different property
			if ( $dependencies['siblings'] ) {
				foreach ( $dependencies['siblings'] as $sibling_selector => $sibling_property ) {
					$return .= $sibling_selector . " { " . $sibling_property . ": " . $mod . ";  }\r\n";
				}
			}

			//* Check dependencies for other affected properties
			if ( is_array($dependencies) && array_key_exists( 'affects', $dependencies ) && $dependencies['affects'] ) {

				foreach ( $dependencies['affects'] as $affect_selector ) {

					$method            = "";
					$method_close      = "";
					$affect_properties = [];

					if ( $dependencies['affects_values'][ $affect_selector ] ) {

						$return .= $affect_selector . " { ";

						$return .= $dependencies['affects_values'][ $affect_selector ];

						$return .= " }\r\n";

					}

					if ( $dependencies['affects_factors'][ $affect_selector ] ) {

						$factor_property = key( $dependencies['affects_factors'][ $affect_selector ] );
						$affects_factor  = current( $dependencies['affects_factors'][ $affect_selector ] );
						$affects_value   = floor($mod * $affects_factor);

						$return .= $affect_selector . " { ";

						$return .= $factor_property . ": " . $prefix . $affects_value . $postfix . "; ";

						$return .= " }\r\n";

					}

					if ( $dependencies['affects_percentages'][ $affect_selector ] ) {

						$percent_numerator   = key( $dependencies['affects_percentages'][ $affect_selector ] );
						$percent_denominator = current( $dependencies['affects_percentages'][ $affect_selector ] );
						$affects_percent     = $this->get_field_value( $percent_numerator ) / $this->get_field_value( $percent_denominator );

						$return .= $affect_selector . " { ";

						foreach ( $affect_properties as $single_property ) {
							$return .= $single_property . ": " . $method . $affects_percent . $method_close . "; ";
						}

						$return .= " }\r\n";

						next( $dependencies['affects_percentages'] );
					}

				}
			}

			//* $echo is true and there are no media queries for this mod, echo it out
			if ( $echo && ! $dependencies['media_query'] ) {

				echo $return;

			}

			//* If there are media queries add them to static query array
			if ( $dependencies['media_query'] ) {

				$media_query = $dependencies['media_query'];

				self::$media_queries[ $media_query ] .= $return;

			}

		} // end if( $mod )

		return $return;
	}

} // end class
