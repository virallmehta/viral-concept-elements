<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/virallmehta
 * @since      1.0.0
 *
 * @package    Viral_Concept_Elements
 * @subpackage Viral_Concept_Elements/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Viral_Concept_Elements
 * @subpackage Viral_Concept_Elements/includes
 * @author     Viral Mehta <virallmehta@gmail.com>
 */
class Viral_Concept_Elements_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'viral-concept-elements',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
