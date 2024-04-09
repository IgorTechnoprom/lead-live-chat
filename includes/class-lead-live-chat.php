<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://klimauredajihrvatska.hr/
 * @since      1.0.0
 *
 * @package    Lead_Live_Chat
 * @subpackage Lead_Live_Chat/includes
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
 * @package    Lead_Live_Chat
 * @subpackage Lead_Live_Chat/includes
 * @author     Igor Lovrinov <igor.technoprom@gmail.com>
 */
class Lead_Live_Chat {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Lead_Live_Chat_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

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
	 * - Lead_live_chat_Loader. Orchestrates the hooks of the plugin.
	 * - Lead_live_chat_i18n. Defines internationalization functionality.
	 * - Lead_live_chat_Admin. Defines all hooks for the admin area.
	 * - Lead_live_chat_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for loading composer dependencies.
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'includes/vendor/autoload.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'includes/class-lead-live-chat-loader.php';

		/**
		 * This file is loaded only on local environement for test or debug.
		 */
		if( $_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' ){
			require_once LEAD_LIVE_CHAT_PLUGIN_PATH. 'includes/dev-toolkits.php';
		}
		
		/**
		 * The global functions for this plugin
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'includes/global-functions.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'includes/class-lead-live-chat-i18n.php';

		/**
		 * The class responsible of settings.
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'admin/class-settings.php';
		
		/**
		 * The class responsible of cron job.
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'admin/class-cron-job.php';

		/**
		 * The class responsible of shortcodes.
		 */
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'public/class-shortcodes.php';

		$this->loader = new Lead_live_chat_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Lead_live_chat_i18n();
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

		$lead_live_chat_settings = new Lead_Live_Chat_Settings();
		$this->loader->add_action( 'admin_menu', $lead_live_chat_settings, 'add_settings_menu' );

		$lead_live_chat_cron_job = new Lead_Live_Chat_Cron_Job();

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$lead_live_chat_shortcodes = new Lead_Live_Chat_Shortcodes();
		$this->loader->add_action( 'init', $lead_live_chat_shortcodes, 'add_shortcodes' );

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
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Lead_Live_Chat_Loader    Orchestrates the hooks of the plugin.
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
		return defined( 'LEAD_LIVE_CHAT_VERSION' ) ? LEAD_LIVE_CHAT_VERSION : '1.0.0';
	}

}
