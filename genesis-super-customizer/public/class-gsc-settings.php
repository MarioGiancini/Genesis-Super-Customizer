<?php

/**
 * Register widget styles customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Settings extends GSC_Base {

	protected $new_section = true;

	protected $mod_section = 'gsc_settings';

	protected $section_title = 'Super Customizer Settings';

	protected $section_desc = 'Some global settings for Genesis Super Customizer.';

	protected $section_priority = 5;

	protected $no_css = true;

	//* Setup mods here to get for output
	protected function get_mods() {

		$this->mod_settings = array(
			'gsc_use_options'    => array(
				'css'         => array(),
				'priority'    => 10,
				'type'        => 'checkbox',
				'default'     => 1,
				'label'       => 'Store As Options',
				'description' => 'By default <b>Options</b> are used and not <b>Theme Mods</b> to customize your Genesis 
				child theme. This means that your Super Customizer settings stay intact even if you switch child themes, 
				and that you can export them from the Genesis Import/Export admin page. If you wish to store these settings 
				with the child theme instead (if you are using multiple), or you wish to <b>enable Live Previews</b>, 
				uncheck this setting. Please note that this will remove any current styles you have in place. Check 
				this again to restore those settings from <b>Options</b>. <br><br><b>Please note you will need to <a id="options-reload" href="">reload the page</a> for the change to take affect after you publish it.</b>',
				'option'      => true, // will always be stored as option
			),
		);

	}

} // end class

new GSC_Settings;
