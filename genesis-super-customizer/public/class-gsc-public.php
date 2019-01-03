<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines plugin name, version, and hooks to
 * public stylesheets, JavaScript, and theme supports.
 *
 * @link       http://supercustomizer.com
 * @since      1.0.0
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
	 * @var      string     $plugin_name
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string     $version
	 */
	private $version;

	/**
	 * Scripts to enqueue and defer.
	 *
	 * @since   1.2.0
	 * @var     array      $scripts
	 */
	private $scripts = array('gsc-fixed-header');

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
		// Removed and added inline
	}

	public function inline_styles() {

		if( function_exists( 'genesis_get_option' ) && genesis_get_option( 'fixed_header', 'genesis-customizer-settings' ) ) { ?>

			<style type="text/css" id="gsc-base">
				.site-header,
				.title-area,
				.title-area a,
				.site-header .wrap,
				.site-header nav,
				.site-header .genesis-nav-menu a,
				.site-title,
				.site-description {
					-webkit-transition: all 0.3s ease-in-out;
					-moz-transition: all 0.3s ease-in-out;
					-ms-transition: all 0.3s ease-in-out;
					-o-transition: all 0.3s ease-in-out;
					transition: all 0.3s ease-in-out;
				}
			</style>

			<?php
		}
	}

	/**
	 * Register the scripts for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if( genesis_get_option( 'fixed_header', 'genesis-customizer-settings' ) ) {
			wp_enqueue_script( 'gsc-fixed-header', plugin_dir_url( __FILE__ ) . 'js/gsc-fixed-header.js', array( 'jquery' ), $this->version, true );
		}

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
		$logo_width 	= 320;
		$logo_height 	= 80;
		$flex_width 	= false;
		$flex_height 	= false;

		//* If this Genesis function has been declared first, then assign customizer values. Sometimes showed an error.
		if( function_exists( 'genesis_get_option' ) ) {
			$logo_width 	= genesis_get_option( 'logo_width', 'genesis-customizer-settings' );
			$logo_height 	= genesis_get_option( 'logo_height', 'genesis-customizer-settings' );
			$flex_width 	= genesis_get_option( 'flex_crop', 'genesis-customizer-settings' ) ? true : false;
			$flex_height 	= genesis_get_option( 'flex_crop', 'genesis-customizer-settings' ) ? true : false;
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

	/**
	 * Add async attribute to scripts for optimized page load.
	 * This code is based in Mathew Horne blog post.
	 *
	 * @see https://matthewhorne.me/defer-async-wordpress-scripts/
	 * @since 1.2.0
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return mixed
	 */
	public function add_async_attribute( $tag, $handle ) {
		// check if this script is in the array
		if ( in_array( $handle, $this->scripts ) ) {
			// return with async
			return str_replace( ' src', ' async="async" src', $tag );
		} else {
			// return without async
			return $tag;
		}
	}

	/**
	 * Add defer attribute to scripts for optimized page load.
	 * This code is based in Mathew Horne blog post.
	 *
	 * @see https://matthewhorne.me/defer-async-wordpress-scripts/
	 * @since 1.2.0
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return mixed
	 */
	public function add_defer_attribute( $tag, $handle ) {
		// check if this script is in the array
		if ( in_array( $handle, $this->scripts ) ) {
			// return with defer
			return str_replace( ' src', ' defer="defer" src', $tag );
		} else {
			// return without async
			return $tag;
		}
	}
}
