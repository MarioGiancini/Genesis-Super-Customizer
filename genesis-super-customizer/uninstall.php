<?php

/**
* Fired when the plugin is uninstalled.
*
* @link       http://supercustomizer.com
* @since      1.0.0
*
* @package    Genesis_Super_Customizer
*/

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}

delete_option( 'genesis-customizer-settings' );
