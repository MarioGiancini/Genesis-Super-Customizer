<?php

/**
 * Dashboard-specific functionality.
 *
 * @link		http://supercustomizer.com
 * @since		1.0.0
 *
 * @package		Geneis_Super_Customizer
 * @subpackage	Geneis_Super_Customizer/admin
 */

/**
 * The dashboard and admin specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for enqueuing
 * the dashboard and admin specific stylesheet, JavaScript, and other functions.
 *
 * @package    	Geneis_Super_Customizer
 * @subpackage 	Geneis_Super_Customizer/admin
 * @author     	Mario Giancini <mario.giancini@gmail.com>
 */
class GSC_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string		$plugin_name	The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string		$version		The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string		$plugin_name 	The name of this plugin.
	 * @var      string		$version    	The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since	1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gsc-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for admin.
	 *
	 * @since	1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gsc-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	/**
	 * Customize the footer credits text
	 *
	 * @since 	1.0.0
	 * @var   	string $creds	Footer credits text from customizer.
	 * @return 	mixed|string
	 */
	public function footer_options_credits_text( $creds ) {

		$settings_field = GSC_Base::$default_settings_field;

		$custom_credits = genesis_get_option( 'footer_credits_text', $settings_field );
		if ( $custom_credits ) return $custom_credits;
		else return $creds;
	}

	/**
	 * Add customizer export functionality to genesis
	 *
	 * @since	1.0.0
	 * @var		array $options	Array of genesis export options.
	 * @return	array
	 */
	public function gsc_export_settings_field( $options ) {

		$options['customizer'] = array(
			'label' => __( 'Customizer Settings', 'genesis-sc' ),
			'settings-field' => 'genesis-customizer-settings',
		);

		return $options;

	}

	/**
	 * Updated existing mod and section settings in the Customizer.
	 *
	 * @since   1.0.0
	 * @param 	$wp_customize
	 */
	public function update_existing_mods( $wp_customize ) {

		$wp_customize->get_control( 'blogdescription' )->label = 'Tagline - Description';
		$wp_customize->get_control( 'display_header_text' )->label = 'Display Header Text On Image.';
		$wp_customize->get_control( 'display_header_text' )->description = 'Applies if you have are using a header image.';
		$wp_customize->get_section( 'colors' )->title = 'Theme Colors';
		$wp_customize->get_section( 'colors' )->description = 'Set your theme colors here. Links and titles will automatically be colored to match the main theme colors, or you can adjust individual settings in other sections.';
		
		$wp_customize->remove_control('background_color');
		$wp_customize->remove_control('header_textcolor');

		//* Change these when instant preview is added
		// $wp_customize->get_setting( 'blogname' )->transport='postMessage';
		// $wp_customize->get_setting( 'blogdescription' )->transport='postMessage';
		// $wp_customize->get_setting( 'header_textcolor' )->transport='postMessage';
		// $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	}

}
