<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://supercustomizer.com
 * @since      1.0.0
 *
 * @package    Geneis_Super_Customizer
 * @subpackage Geneis_Super_Customizer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks to
 * public stylesheets, JavaScript, and theme supports.
 *
 * @package    Geneis_Super_Customizer
 * @subpackage Geneis_Super_Customizer/public
 * @author     Mario Giancini <mario.giancini@gmail.com>
 */
class GSC_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'gsc-shrink-header', plugin_dir_url( __FILE__ ) . 'css/gsc-shrink-header.css', array(), $this->version );

	}

	/**
	 * Register the scripts for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'gsc-add-bumper', plugin_dir_url( __FILE__ ) . 'js/gsc-add-bumper.js', array( 'jquery' ), $this->version );
		wp_enqueue_script( 'gsc-shrink-header', plugin_dir_url( __FILE__ ) . 'js/gsc-shrink-header.js', array( 'jquery' ), $this->version );

	}

	/**
	* Add theme support for custom header with options.
	*
	* @since    1.0.0
	*/
	public function set_custom_header() {

		//* Add support for custom header but first remove if already set
		if( current_theme_supports( 'custom-header' ) ) {
			remove_theme_support( 'custom-header' );
		}

		//* Default values
		$logo_width 	= 360;
		$logo_height 	= 80;
		$flex_width 	= false;
		$flex_height 	= false;

		//* If this Genesis function has been declaired first, then assign customizer values. Sometimes showed an error.
		if( function_exists( 'genesis_get_option' ) ) {
			$logo_width 	= genesis_get_option( 'logo_width', 'genesis-customizer-settings' );
			$logo_height 	= genesis_get_option( 'logo_height', 'genesis-customizer-settings' );
			$flex_width 	= genesis_get_option( 'flex_crop', 'genesis-customizer-settings' ) === 1 ? true : false;
			$flex_height 	= genesis_get_option( 'flex_crop', 'genesis-customizer-settings' ) === 1 ? true : false;
		}

		//* Add custom header support with option settings
		add_theme_support( 'custom-header', array(
		    'width'           => $logo_width,
		    'height'          => $logo_height,
		    'header-selector' => '.site-title a',
		    'flex-width'      => $flex_width,
		    'flex-height'     => $flex_height,
		  )
		);

	}

	/**
	* Add theme support for custom background.
	*
	* @since    1.0.0
	*/
	public function set_custom_background() {

		//* Add support for custom background if not already set
		if( ! current_theme_supports( 'custom-background' ) ) {
			add_theme_support( 'custom-background' );
		}

	}

	/**
	* Add theme support for genesis woocommerce connect if
	* both plugins are installed and active.
	*
	* @since    1.0.0
	*/
	public function set_genesis_woocommerce_connect() {

		//* Add support for custom background if not already set
		if( ! current_theme_supports( 'genesis-connect-woocommerce' ) ) {
			add_theme_support( 'genesis-connect-woocommerce' );
		}

	}

}
