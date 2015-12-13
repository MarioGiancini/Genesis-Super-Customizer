<?php

/**
 * Fired during plugin activation
 *
 * @link       http://supercustomizer.com
 * @since      1.0.0
 *
 * @package    Geneis_Super_Customizer
 * @subpackage Geneis_Super_Customizer/includes
 * @author     Mario Giancini <mario.giancini@gmail.com>
 */
class GSC_Activator {

	/**
	 * Activation Hook to check the theme name.
	 *
	 * Confirm site is using Genesis 2.0 or higher, or it's time to die.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$latest = '2.0';
		$theme_info = wp_get_theme( 'genesis' );

		if ( 'genesis' != wp_basename( get_template_directory() ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( sprintf( __( 'Sorry, to use Genesis Super Customizer you have to install and activate the <a href="%s">Genesis</a> theme first.', 'genesis-super-customizer'), 'http://supercustomizer.com/genesis' ) );
		}

		if ( version_compare( $theme_info['Version'], $latest, '<' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate plugin
			wp_die( sprintf( __( 'Sorry, you can\'t activate %1$sGenesis Super Customizer%2$s unless you have installed the %3$sGenesis %4$s%5$s. Go back to the %6$sPlugins Page%5$s.', 'genesis-super-customizer' ), '<em>', '</em>', '<a href="http://supercustomizer.com/genesis" target="_blank">', $latest, '</a>', '<a href="javascript:history.back()">' ) );
		}

	}

}
