<?php

/**
* Defines the core Genesis Super Customizer class
*
* A class definition that includes attributes and functions used across both the
* public-facing side of the site and the dashboard.
*
* @link       http://supercustomizer.com
* @since      1.0.0
*
* @package    Geneis_Super_Customizer
* @subpackage Geneis_Super_Customizer/includes
*/

/**
* The core plugin class.
*
* Define internationalization, dashboard-specific hooks, and
* public-facing site hooks.
*
* Also maintains the unique identifier of this plugin as well as the current
* version of the plugin.
*
* @since      1.0.0
* @package    Geneis_Super_Customizer
* @subpackage Geneis_Super_Customizer/includes
* @author     Mario Giancini
*/

class Geneis_Super_Customizer {

  /**
  * The loader that's responsible for maintaining and registering all hooks that power
  * the plugin.
  *
  * @since    1.0.0
  * @access   protected
  * @var      GSC_Loader    $loader    Maintains and registers all hooks.
  */
  protected $loader;

  /**
  * The unique identifier of this plugin.
  *
  * @since    1.0.0
  * @access   protected
  * @var      string    $plugin_name    The string used to uniquely identify.
  */
  protected $plugin_name;

  /**
  * The current version of the plugin.
  *
  * @since    1.0.0
  * @access   protected
  * @var      string    $version    The current version.
  */
  protected $version;

  /**
  * Define the core functionality of the plugin.
  *
  * Set the plugin name and the plugin version that can be used throughout the plugin.
  * Load the dependencies, define the locale, and set the hooks for the Dashboard and
  * the public-facing side of the site.
  *
  * @since    1.0.0
  */
  public function __construct() {

    $this->plugin_name = 'genesis-super-customizer';
    $this->version = '1.0.0';

    $this->load_dependencies();
    $this->set_locale();
    $this->load_customizer_sections();
    $this->define_admin_hooks();
    $this->define_public_hooks();

  }

  /**
  * Load the required dependencies for this plugin.
  *
  * Include the following files that make up the plugin:
  *
  * - GSC_Loader. Orchestrates the hooks of the plugin.
  * - GSC_i18n. Defines internationalization functionality.
  * - GSC_Admin. Defines all hooks for the dashboard.
  * - GSC_Public. Defines all hooks for the public side of the site.
  *
  * Create an instance of the loader which will be used to register the hooks
  * with WordPress.
  *
  * @since    1.0.0
  * @access   private
  */
  private function load_dependencies() {

    /**
    * Helper functions outside of classes.
    */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/gsc-helpers.php';

    /**
    * The class responsible for orchestrating the actions and filters of the core.
    */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gsc-loader.php';

    /**
    * The class responsible for defining internationalization functionality.
    */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gsc-i18n.php';

    /**
    * The class responsible for defining all actions that occur in the Dashboard.
    */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-gsc-admin.php';

    /**
    * The class responsible for defining all Customizer and public-facing actions.
    */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-public.php';

    $this->loader = new GSC_Loader();

  }

  /**
  * Define the locale for this plugin for internationalization.
  *
  * Uses the GSC_i18n class in order to set the domain and to register the hook
  * with WordPress.
  *
  * @since    1.0.0
  * @access   private
  */
  private function set_locale() {

    $plugin_i18n = new GSC_i18n();
    $plugin_i18n->set_domain( $this->get_plugin_name() );

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

  }

  /**
  * Register all of the customier options and settings of the plugin.
  * Needed before admin to setup genesis admin page.
  *
  * @since    1.0.0
  * @access   private
  */
  private function load_customizer_sections() {

    //* Register the base class
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-base.php';

    //* Register Children classes.
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-title-tagline.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-colors.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-header.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-header-image.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-nav.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-content.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-comments.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-forms.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-sidebars.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-buttons.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-widget-styles.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-footer.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-footer-credits.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-breadcrumbs.php';

    //* Register Media Queries Last
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gsc-media-queries.php';

  }

  /**
  * Register all of the hooks related to the dashboard functionality
  * of the plugin.
  *
  * @since    1.0.0
  * @access   private
  */
  private function define_admin_hooks() {

    $plugin_admin = new GSC_Admin( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    $this->loader->add_action( 'customize_register', $plugin_admin, 'update_existing_mods', 15 );

    $this->loader->add_action( 'init', 'GSC_Base', 'gsc_register_defaults' );

    $this->loader->add_filter( 'genesis_footer_output', $plugin_admin, 'footer_options_credits_text', 10 );
    $this->loader->add_filter( 'genesis_export_options', $plugin_admin, 'gsc_export_settings_field' );


  }

  /**
  * Register all of the hooks related to the public-facing functionality
  * of the plugin.
  *
  * @since    1.0.0
  * @access   private
  */
  private function define_public_hooks() {

    $plugin_public = new GSC_Public( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
    $this->loader->add_action( 'after_setup_theme', $plugin_public, 'set_custom_header', 15 );
    $this->loader->add_action( 'after_setup_theme', $plugin_public, 'set_custom_background', 15 );

  }

  /**
  * Run the loader to execute all of the hooks with WordPress.
  *
  * @since    1.0.0
  */
  public function run() {
    $this->loader->run();
  }

  /**
  * The name of the plugin used to uniquely identify it within the context of
  * WordPress and to define internationalization functionality.
  *
  * @since     1.0.0
  * @return    string    The name of the plugin.
  */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
  * The reference to the class that orchestrates the hooks with the plugin.
  *
  * @since     1.0.0
  * @return    GSC_Loader    Orchestrates the hooks of the plugin.
  */
  public function get_loader() {
    return $this->loader;
  }

  /**
  * Retrieve the version number of the plugin.
  *
  * @since     1.0.0
  * @return    string    The version number of the plugin.
  */
  public function get_version() {
    return $this->version;
  }

}
