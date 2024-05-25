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

function block_ai_crawlers_wp_admin_style($hook) {
	wp_enqueue_style( 'custom_wp_admin_css', plugins_url('/css/admin-style.css', __FILE__) );
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
	$settings_HTML = file_get_contents( plugins_url( 'settings-content.php' , __FILE__ ));
	echo $settings_HTML;
}
