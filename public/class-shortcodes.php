<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Lead_live_chat_Shortcodes {
	
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}
	
	/**
	 * add_shrortcodes
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function add_shortcodes() {
		add_shortcode( 'lead_live_chat_informations', array( $this, 'shortcode_lead_live_chat_informations' ) );
	}
	
	/**
	 * shortcode_lead_live_chat_informations
	 * 
	 * @since    1.0.0
	 * @param  mixed $atts
	 * @return void
	 */
	public function shortcode_lead_live_chat_informations() {
		return 'Lead live chat v' . LEAD_LIVE_CHAT_VERSION;
	}
}
