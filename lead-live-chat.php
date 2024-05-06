<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Lead live chat
 * Plugin URI:        https://klimauredajihrvatska.hr/
 * Description:       Lead live chat take phone, email from leads and send to email.
 * Version:           1.0.0
 * Author:            Igor Lovrinov
 * Author URI:        https://klimauredajihrvatska.hr/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lead-live-chat
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/**
 * Check if your are in local or production environment
 */
$is_local = isset($_SERVER['REMOTE_ADDR']) && ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1');

/**
 * If you are in local environment, you can use the version number as a timestamp for better cache management in your browser
 */
$version  = get_file_data( __FILE__, array( 'Version' => 'Version' ), false )['Version'];

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LEAD_LIVE_CHAT_VERSION', $version );

/**
 * You can use this const for check if you are in local environment
 */
define( 'LEAD_LIVE_CHAT_DEV_MOD', $is_local );

/**
 * Plugin Name Path for plugin includes.
 */
define( 'LEAD_LIVE_CHAT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin Name URL for plugin sources (css, js, images etc...).
 */
define( 'LEAD_LIVE_CHAT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

$css_url_iframe = LEAD_LIVE_CHAT_PLUGIN_URL . 'node_modules/iframe-resizer/css/iframestyle.css';
$js_url_if_resizer = LEAD_LIVE_CHAT_PLUGIN_URL . 'node_modules/iframe-resizer/js/iframeResizer.js';
$js_url_if_resizer_min = LEAD_LIVE_CHAT_PLUGIN_URL . 'node_modules/iframe-resizer/js/iframeResizer.min.js';
$js_url_if_widget = LEAD_LIVE_CHAT_PLUGIN_URL . 'node_modules/iframe-resizer/js/iframeWidget.js';
$js_url_if_content = LEAD_LIVE_CHAT_PLUGIN_URL . 'node_modules/iframe-resizer/js/iframeResizer.contentWindow.js';
$js_url_if_content_min = LEAD_LIVE_CHAT_PLUGIN_URL . 'node_modules/iframe-resizer/js/iframeResizer.contentWindow.min.js';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lead-live-chat-activator.php
 */
register_activation_hook( __FILE__, function(){
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lead-live-chat-activator.php';
	Lead_live_chat_Activator::activate();
} );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lead-live-chat-deactivator.php
 */
register_deactivation_hook( __FILE__, function(){
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lead-live-chat-deactivator.php';
	Lead_live_chat_Deactivator::deactivate();
} );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lead-live-chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lead_live_chat() {

	$plugin = new Lead_live_chat();
	$plugin->run();

}
run_lead_live_chat();
