<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Lead_live_chat_Settings {
	
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		
	}
		
	/**
	 * add_settings_menu
	 *
	 * @return void
	 */
	public function add_settings_menu() {
		add_menu_page(
			__('Lead live chat Settings', 'lead-live-chat'),
			__('Lead live chat', 'lead-live-chat'),
			'manage_options',
			'lead-live-chat-settings',
			array( $this, 'render_settings_page' ),
			'dashicons-admin-generic',
			100
		);
	}
	
	/**
	 * render_settings_page
	 *
	 * @return void
	 */
	public function render_settings_page() {
		require_once LEAD_LIVE_CHAT_PLUGIN_PATH . 'admin/templates/page-settings.php';
	}
}