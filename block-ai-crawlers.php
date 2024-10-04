<?php
/**
 * Plugin Name:     Block AI Crawlers
 * Description:     Blocks AI crawlers and bots via robots.txt and meta tags.
 * Author:          Bob Matyas
 * Author URI:      https://www.bobmatyas.com
 * Text Domain:     block-ai-crawlers
 * Version:         1.4.0
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package         Block_AI_Crawlers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'robots_txt', 'block_ai_robots_txt', 1, 2 );

require __DIR__ . '/inc/settings.php';

/**
 * Adds blocking directives to robots.txt
 *
 * @param string $robots inputs default robots.txt.
 * @return string
 */
function block_ai_robots_txt( $robots ) {
		$robots .= "\n# Block AI Crawlers\n\n";
		$robots .= "User-agent: AI2Bot\n";
		$robots .= "User-agent: AmazonBot\n";
		$robots .= "User-agent: Applebot-Extended\n";
		$robots .= "User-agent: anthropic-ai\n";
		$robots .= "User-agent: Bytespider\n";
		$robots .= "User-agent: CCBot\n";
		$robots .= "User-agent: ChatGPT-User\n";
		$robots .= "User-agent: ClaudeBot\n";
		$robots .= "User-agent: Claude-Web\n";
		$robots .= "User-agent: cohere-ai\n";
		$robots .= "User-agent: Diffbot\n";
		$robots .= "User-agent: FacebookBot\n";
		$robots .= "User-agent: GPTBot\n";
		$robots .= "User-agent: Google-Extended\n";
		$robots .= "User-agent: ImagesiftBot\n";
		$robots .= "User-agent: Meta-ExternalAgent\n";
		$robots .= "User-agent: Meta-ExternalFetcher\n";
		$robots .= "User-agent: OAI-SearchBot\n";
		$robots .= "User-agent: Omgili\n";
		$robots .= "User-agent: Omgilibot\n";
		$robots .= "User-agent: PetalBot\n";
		$robots .= "User-agent: PerplexityBot\n";
		$robots .= "User-agent: Timpibot\n";
		$robots .= "User-agent: YouBot\n";
		$robots .= "User-agent: webzio\n";
		$robots .= "User-agent: webzio-extended\n";
		$robots .= "Disallow: /\n\n";
		$robots .= "# End Block AI Crawlers\n";
		return ( $robots );
}

add_action( 'wp_head', 'block_ai_meta_tag', 1 );

/**
 * Adds no AI meta tag
 */
function block_ai_meta_tag() {
	echo '<meta name="robots" content="noai, noimageai" />';
}

/**
 * Plugin activation
 */
function block_ai_activate() {
	if ( file_exists( "{$_SERVER['DOCUMENT_ROOT']}/robots.txt" ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( '<h1>Could Not Activate Plugin</h1><p>Your site uses a physical <code>robots.txt</code> file. This plugin can only be activated when using the built-in virtual <code>robots.txt</code> provided by WordPress.</p> <h2>To Activate</h2><p>Move the <code>robots.txt</code> file outside of your root directory or rename it to something like <code>robots.txt.bak</code>. This file is located at:<br><br><b>' . esc_html( "{$_SERVER['DOCUMENT_ROOT']}/robots.txt" ) . '</b></p> <p>Once that is done, please try reactivating the plugin.</p>', '', array( 'back_link' => true ) );
	}
}

register_activation_hook( __FILE__, 'block_ai_activate' );

add_filter( 'plugin_action_links', 'block_ai_prepend_plugin_settings_link', 10, 2 );

/**
 * Adds seettings link to plugins page
 *
 * @param array  $links_array            An array of the plugin's metadata.
 * @param string $plugin_file_name       Path to the plugin file.
 * @return array $links_array
 */
function block_ai_prepend_plugin_settings_link( $links_array, $plugin_file_name ) {
	if ( strpos( $plugin_file_name, basename( __FILE__ ) ) ) {
		array_unshift( $links_array, '<a href="' . get_admin_url() . 'options-general.php?page=block-ai-crawlers">Settings</a>' );
	}
	return $links_array;
}


/**
 * Adds ratings nudge to plugins page
 *
 * @access public
 * @param array  $links_array            An array of the plugin's metadata.
 * @param string $plugin_file_name       Path to the plugin file.
 * @return  array $links_array
 */
function block_ai_append_plugin_rating( $links_array, $plugin_file_name ) {
	if ( strpos( $plugin_file_name, basename( __FILE__ ) ) ) {

		$links_array[] = "<a href='https://wordpress.org/support/plugin/block-ai-crawlers/reviews/#new-post' target='_blank' title='Rate 5 Stars'>
		<i class='rate-stars'>"
		. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
		. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
		. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
		. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
		. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
		. '</i></a>';

		$stars_color = '#ffb900';

		echo '<style>'
		. '.rate-stars{display:inline-block;color:' . $stars_color . ';position:relative;top:3px;}'
		. '.rate-stars svg {fill:' . $stars_color . ';}'
		. '</style>';
	}
 
	return $links_array;
}

add_filter( 'plugin_row_meta', 'block_ai_append_plugin_rating', 10, 4 );