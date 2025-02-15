<?php
/**
 * Configures settings display in admin view for plugin.
 *
 * @package "Block_AI_Crawlers"
 */

add_action( 'admin_menu', 'block_ai_crawlers_add_settings_menu' );

/**
 * Load admin custom CSS
 *
 * @return void
 */
function block_ai_crawlers_wp_admin_style() {
	wp_enqueue_style( 'custom_wp_admin_css', plugins_url( '/css/admin-style.css', __FILE__ ), array(), '1.5.0' );
}
add_action( 'admin_enqueue_scripts', 'block_ai_crawlers_wp_admin_style' );

/**
 * Add settings menu to WP Admin for plugin
 *
 * @return void
 */
function block_ai_crawlers_add_settings_menu() {

	add_options_page(
		'Block AI Crawlers',
		'Block AI Crawlers',
		'manage_options',
		'block-ai-crawlers',
		'block_ai_crawlers_option_page'
	);
}

/**
 * Displays options page
 *
 * @return void
 */
function block_ai_crawlers_option_page() {
	include plugin_dir_path( __FILE__ ) . 'settings-html.php';
}
