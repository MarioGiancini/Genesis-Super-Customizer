<?php

/**
 * Register media query customizer settings
 *
 * @link       http://genesissupercustomizer.com
 * @since      1.0.0
 *
 * @package    Genesis_Super_Customizer
 * @subpackage Genesis_Super_Customizer/includes
 */

class GSC_Media_Queries extends GSC_Base {

	protected $new_section = false;

	/**
	 * This will output all mod settings in media queries. Called from __construct()
	 *
	 * @uses $this->media_queries
	 *
	 * @since 1.0.0
	 */
	public function do_media_queries() {
		echo '<style type="text/css" id="gsc_media_query">';
		echo "\r\n";

		foreach ( parent::$media_queries as $query_size => $query_styles ) {
			echo '@media only screen and (' . $query_size . ') {';
			echo "\r\n";
			echo $query_styles;
			echo "\r\n";
			echo '}';
			echo "\r\n";
		}

		echo '</style>';

	}

} // end class

new GSC_Media_Queries;
