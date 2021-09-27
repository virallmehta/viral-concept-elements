<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/virallmehta
 * @since             1.0.0
 * @package           Viral_Concept_Elements
 *
 * @wordpress-plugin
 * Plugin Name:       Viral Concept Elements
 * Plugin URI:        https://github.com/virallmehta/viral-concept-elements
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Viral Mehta
 * Author URI:        https://github.com/virallmehta
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       viral-concept-elements
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Defining plugin constants.
 *
 * @since 1.0.0
 */
define('VCE_PLUGIN_FILE', __FILE__);
define('VCE_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('VCE_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('VCE_PLUGIN_URL', trailingslashit(plugins_url('/', __FILE__)));
define('VCE_PLUGIN_NAME', 'viral-concept-elements');

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VIRAL_CONCEPT_ELEMENTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-viral-concept-elements-activator.php
 */
function activate_viral_concept_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-viral-concept-elements-activator.php';
	Viral_Concept_Elements_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-viral-concept-elements-deactivator.php
 */
function deactivate_viral_concept_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-viral-concept-elements-deactivator.php';
	Viral_Concept_Elements_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_viral_concept_elements' );
register_deactivation_hook( __FILE__, 'deactivate_viral_concept_elements' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-viral-concept-elements.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_viral_concept_elements() {

	$plugin = new Viral_Concept_Elements();
	$plugin->run();

}
///run_viral_concept_elements();

global $plugin_viral_concept_elements; 
$plugin_viral_concept_elements = new Viral_Concept_Elements();
$plugin_viral_concept_elements->run();