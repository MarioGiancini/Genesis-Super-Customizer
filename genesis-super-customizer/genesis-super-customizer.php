<?php
/**
 * @link              http://supercustomizer.com
 * @since             1.0.0
 * @package           Geneis_Super_Customizer
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Super Customizer
 * Plugin URI:        http://supercustomizer.com/
 * Description:       Genesis Super Customizer is <strong>the best way</strong> to customize the design of the <a href="http://studiopress.com">Genesis Theme</a>. It adds options to customize colors, create a fixed header that shrinks on scroll, upload logos, and much more, all through native Wordpress customizer.
 * Version:           1.0.7
 * Author:            Mario Giancini
 * Author URI:        http://mariogiancini.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       genesis-super-customizer
 * Domain Path:       /languages
 */

/*********************************************
 *
 * This plugin requires the Genesis framework
 * http://studiopress.com
 *
 *********************************************/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
* Runs during plugin activation.
* This action is documented in includes/class-plugin-name-activator.php
*/
function activate_genesis_super_customizer() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-gsc-activator.php';
  GSC_Activator::activate();
}

/**
* Runs during plugin deactivation.
* This action is documented in includes/class-plugin-name-deactivator.php
*/
function deactivate_genesis_super_customizer() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-gsc-deactivator.php';
  GSC_Deactivator::deactivate();
}


register_activation_hook( __FILE__, 'activate_genesis_super_customizer' );
register_deactivation_hook( __FILE__, 'deactivate_genesis_super_customizer' );


/**
* The core plugin class that is used to define internationalization,
* dashboard-specific hooks, and public-facing site hooks.
*/
require_once plugin_dir_path( __FILE__ ) . 'includes/class-gsc.php';

/**
* Begins execution of the plugin.
*
* Since everything within the plugin is registered via hooks,
* then kicking off the plugin from this point in the file does
* not affect the page life cycle.
*
* @since    1.0.0
*/
function run_genesis_super_customizer() {

  $plugin = new Geneis_Super_Customizer();
  $plugin->run();

}

/**
* First check if Genesis or child theme is still active. Deactivate if not.
* Prevents white screen of death when themes are switched.
*
* @since    1.0.0
*/
if ( 'genesis' != wp_basename( get_template_directory() ) ) {
  add_action( 'admin_init', 'gsc_deactivate' );
  add_action( 'admin_notices', 'gsc_admin_notice' );
  function gsc_deactivate() {
    deactivate_plugins( plugin_basename( __FILE__ ) );
  }
  function gsc_admin_notice() {
    echo '<div class="updated notice is-dismissible"><p><strong>Genesis Super Customizer</strong> has been <strong>deactivated</strong> because it requires the Genensis framework.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
  }
} else {
  run_genesis_super_customizer();
}
