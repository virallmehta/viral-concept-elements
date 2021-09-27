<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/virallmehta
 * @since      1.0.0
 *
 * @package    Viral_Concept_Elements
 * @subpackage Viral_Concept_Elements/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Viral_Concept_Elements
 * @subpackage Viral_Concept_Elements/includes
 * @author     Viral Mehta <virallmehta@gmail.com>
 */
class Viral_Concept_Elements {

	/**
	 * Minimum Elementor Version
	 *
	 * Holds the minimum Elementor version required to run the plugin.
	 * 
	 * @since 	1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.6.0';

	/**
	 * Minimum PHP Version
	 *
	 * Holds the minimum PHP version required to run the plugin.
	 *
	 * @since	1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const  MINIMUM_PHP_VERSION = '5.4' ;	

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Viral_Concept_Elements_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Store plugin main class to allow public access.
	 *
	 * @since    1.0.0
	 * @var object      The main class.
	 */
	public $main;

	/**
	 * Store plugin admin class to allow public access.
	 *
	 * @since    1.0.0
	 * @var object      The admin class.
	 */
	public $admin;

	/**
	 * Store plugin public class to allow public access.
	 *
	 * @since    1.0.0
	 * @var object      The public class.
	 */
	public $public;		

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'VIRAL_CONCEPT_ELEMENTS_VERSION' ) ) {
			$this->version = VIRAL_CONCEPT_ELEMENTS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'viral-concept-elements';

		$this->main = $this;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Viral_Concept_Elements_Loader. Orchestrates the hooks of the plugin.
	 * - Viral_Concept_Elements_i18n. Defines internationalization functionality.
	 * - Viral_Concept_Elements_Admin. Defines all hooks for the admin area.
	 * - Viral_Concept_Elements_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-viral-concept-elements-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-viral-concept-elements-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-viral-concept-elements-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-viral-concept-elements-public.php';

		$this->loader = new Viral_Concept_Elements_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Viral_Concept_Elements_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Viral_Concept_Elements_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$this->admin = new Viral_Concept_Elements_Admin( $this->get_plugin_name(), $this->get_version(), $this->main );

		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_scripts' );

		add_action( 'plugins_loaded',  [ $this->main, 'init' ] );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$this->public = new Viral_Concept_Elements_Public( $this->get_plugin_name(), $this->get_version(), $this->main );

		$this->loader->add_action( 'wp_enqueue_scripts', $this->public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this->public, 'enqueue_scripts' );

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
	 * @return    Viral_Concept_Elements_Loader    Orchestrates the hooks of the plugin.
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

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since	1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', $this->plugin_name ),
			'<strong>' . esc_html__( 'Viral Concept Elementor', $this->plugin_name ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', $this->plugin_name ) . '</strong>'
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 	1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', $this->plugin_name ),
			'<strong>' . esc_html__( 'Viral Concept Elements', $this->plugin_name ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', $this->plugin_name ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since	1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', $this->plugin_name ),
			'<strong>' . esc_html__( 'Viral Concept Elements', $this->plugin_name ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', $this->plugin_name ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/*
	 * Add new Elementor Categories
	 * 
	 * Register new widget categories for Viral Concepts Elements widgets.
	 * 
	 * @since	1.0.0
	 */
	public function add_elementor_category() {
		\Elementor\Plugin::instance()->elements_manager->add_category( 'viral-concepts-elements', [
			'title' => __( 'Viral Concept Elements', $this->plugin_name ),
		], 1 );
	}	

	/*
	 * Initialize on plugin load and register widget category, widgets
	 * 
	 * @since	1.0.0
	 */
	public function init() {
		if ( !did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add new Elementor Categories
		add_action( 'elementor/init',  [ $this, 'add_elementor_category' ] );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );


	}

	/*
	 * On Register Widgets
	 * 
	 * @since	1.0.0
	 */	
	public function on_widgets_registered() {
		$this->register_widgets();
	}

	/*
	 * Include widgets and Register widget to elementor plugin 
	 * 
	 * @since	1.0.0
	 */	
	private function register_widgets() {
		require_once VCE_PLUGIN_PATH . '/widgets/heading.php';
		$classname = "Heading";
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $classname() );
	}

}