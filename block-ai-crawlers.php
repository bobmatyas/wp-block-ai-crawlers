<?php
/**
 * Plugin Name:     Block AI Crawlers
 * Description:     Blocks AI crawlers and bots including ChatGPT via robots.txt and meta tags.
 * Author:          Bob Matyas
 * Author URI:      https://www.bobmatyas.com
 * Text Domain:     block-ai-crawlers
 * Version:         1.0.0
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package         Block_AI_Crawlers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'robots_txt', 'block_ai_robots_txt', 1, 2 );

/**
 * Adds blocking directives to robots.txt
 *
 * @param string $robots inputs default robots.txt.
 * @return string
 */
function block_ai_robots_txt( $robots ) {
		$robots .= "\n# Block Common Crawl - https://commoncrawl.org/big-picture/frequently-asked-questions/ \n User-agent: CCBot \n Disallow: / \n";
		$robots .= "\n# Block ChatGPT - https://platform.openai.com/docs/plugins/bot \n User-agent: ChatGPT-User \n Disallow: / \n";
		$robots .= "\n# Block GPTBot - https://platform.openai.com/docs/gptbot \n User-agent: GPTBot \n  Disallow: / \n";
		$robots .= "\n# Block Google Extended - https://developers.google.com/search/docs/crawling-indexing/overview-google-crawlers?hl=en#common-crawlers \n User-agent: Google-Extended \n  Disallow: / \n";
		$robots .= "\n# Block Facebook - https://developers.facebook.com/docs/sharing/bot \n User-agent: FacebookBot \n  Disallow: / \n";
		$robots .= "\n# Block Omgili - https://webz.io/blog/machine-learning/common-crawl-vs-webz-io-data-which-one-works-best-for-large-language-models/ \n User-agent: Omgili \n  Disallow: / \n";
		return ( $robots );
}

add_action( 'wp_head', 'block_ai_meta_tag', 1 );

/**
 * Adds no robots meta tag
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
