<?php
/**
 * Plugin Name:     Block AI Crawlers
 * Description:     Blocks AI crawlers and bots via robots.txt and meta tags.
 * Author:          Bob Matyas
 * Author URI:      https://www.bobmatyas.com
 * Text Domain:     block-ai-crawlers
 * Version:         1.6.0
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
 * Loads the build-generated crawler list.
 *
 * @return array<string, array{description: string, link: string}>
 */
function block_ai_get_crawlers() {
	static $crawlers = null;

	if ( null !== $crawlers ) {
		return $crawlers;
	}

	$crawlers_file = __DIR__ . '/inc/generated/crawlers.php';
	if ( ! is_readable( $crawlers_file ) ) {
		$crawlers = array();
		return $crawlers;
	}

	$loaded = require $crawlers_file;
	$crawlers = is_array( $loaded ) ? $loaded : array();

	return $crawlers;
}

/**
 * Returns crawler user-agents the site owner has opted out of blocking.
 *
 * @return string[]
 */
function block_ai_get_disabled_crawlers() {
	static $disabled = null;

	if ( null !== $disabled ) {
		return $disabled;
	}

	$stored = get_option( 'block_ai_crawlers_disabled', array() );
	if ( ! is_array( $stored ) ) {
		$disabled = array();
		return $disabled;
	}

	$known    = array_keys( block_ai_get_crawlers() );
	$disabled = array_values( array_intersect( $stored, $known ) );

	return $disabled;
}

/**
 * Adds blocking directives to robots.txt
 *
 * @param string $robots inputs default robots.txt.
 * @param bool   $public Whether the site is public.
 * @return string
 */
function block_ai_robots_txt( $robots, $public ) {
	$crawlers = block_ai_get_crawlers();
	$disabled = block_ai_get_disabled_crawlers();

	if ( ! empty( $disabled ) ) {
		$crawlers = array_diff_key( $crawlers, array_fill_keys( $disabled, true ) );
	}

	if ( empty( $crawlers ) ) {
		$robots .= block_ai_robots_txt_custom_rules();
		return $robots;
	}

	$robots .= "\n# Block AI Crawlers - Built-In Rules\n\n";

	foreach ( array_keys( $crawlers ) as $user_agent ) {
		$robots .= 'User-agent: ' . $user_agent . "\n";
	}

	$robots .= "Disallow: /\n\n";
	$robots .= "# End Block AI Crawlers - Built-In Rules\n";
	$robots .= block_ai_robots_txt_custom_rules();

	return $robots;
}

/**
 * Retrieves custom rules for robots.txt from the settings page.
 *
 * @return string Custom rules for robots.txt.
 */
function block_ai_robots_txt_custom_rules() {
	// Retrieve the user-inputted entries from the settings page.
	$custom_robots_txt = get_option( 'block_ai_crawlers_custom_robots_txt', '' );

	// Output the custom entries to the robots.txt file.
	if ( ! empty( $custom_robots_txt ) ) {
		return "\n# Start Block AI Crawlers - Custom Rules\n" . $custom_robots_txt . "\n# End Block AI Crawlers - Custom Rules\n";
	}

	return '';
}

add_action( 'wp_head', 'block_ai_meta_tag', 1 );

/**
 * Whether the experimental noai meta tag should be output.
 *
 * @return bool
 */
function block_ai_meta_tag_enabled() {
	return '1' === (string) get_option( 'block_ai_crawlers_meta_tag', '1' );
}

/**
 * Adds no AI meta tag
 */
function block_ai_meta_tag() {
	if ( ! block_ai_meta_tag_enabled() ) {
		return;
	}

	echo '<meta name="robots" content="noai, noimageai" />';
}

/**
 * Plugin activation
 */
function block_ai_activate() {
	// Sanitize and validate DOCUMENT_ROOT before use.
	$document_root = isset( $_SERVER['DOCUMENT_ROOT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['DOCUMENT_ROOT'] ) ) : '';
	
	if ( ! empty( $document_root ) && file_exists( $document_root . '/robots.txt' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( '<h1>Could Not Activate Plugin</h1><p>Your site uses a physical <code>robots.txt</code> file. This plugin can only be activated when using the built-in virtual <code>robots.txt</code> provided by WordPress.</p> <h2>To Activate</h2><p>Move the <code>robots.txt</code> file outside of your root directory or rename it to something like <code>robots.txt.bak</code>. This file is located at:<br><br><b>' . esc_html( $document_root . '/robots.txt' ) . '</b></p> <p>Once that is done, please try reactivating the plugin.</p>', '', array( 'back_link' => true ) );
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
		. '.rate-stars{display:inline-block;color:' . esc_attr( $stars_color ) . ';position:relative;top:3px;}'
		. '.rate-stars svg {fill:' . esc_attr( $stars_color ) . ';}'
		. '</style>';
	}

	return $links_array;
}

add_filter( 'plugin_row_meta', 'block_ai_append_plugin_rating', 10, 4 );

add_action( 'admin_init', 'block_ai_crawlers_settings' );

add_action( 'updated_option', 'block_ai_maybe_flush_page_caches', 10, 1 );
add_action( 'added_option', 'block_ai_maybe_flush_page_caches', 10, 1 );

/**
 * Flushes page caches when plugin settings that affect public output change.
 *
 * @param string $option Option name that was added or updated.
 * @return void
 */
function block_ai_maybe_flush_page_caches( $option ) {
	$watched = array(
		'block_ai_crawlers_disabled',
		'block_ai_crawlers_meta_tag',
		'block_ai_crawlers_custom_robots_txt',
	);

	if ( ! in_array( $option, $watched, true ) ) {
		return;
	}

	block_ai_flush_page_caches();
}

/**
 * Best-effort flush of common page / CDN caches.
 *
 * Settings saves are rare; prefer clearing enough to refresh robots.txt and HTML meta tags.
 *
 * @return void
 */
function block_ai_flush_page_caches() {
	static $done = false;

	if ( $done ) {
		return;
	}
	$done = true;

	$robots_url = home_url( '/robots.txt' );

	// WP Rocket — URL then domain (meta tags appear on HTML pages).
	if ( function_exists( 'rocket_clean_files' ) ) {
		rocket_clean_files( $robots_url );
	}
	if ( function_exists( 'rocket_clean_domain' ) ) {
		rocket_clean_domain();
	}

	// LiteSpeed Cache.
	do_action( 'litespeed_purge_url', $robots_url );
	do_action( 'litespeed_purge_all' );

	// WP Super Cache.
	if ( function_exists( 'wp_cache_clear_cache' ) ) {
		wp_cache_clear_cache();
	}

	// W3 Total Cache.
	if ( function_exists( 'w3tc_flush_url' ) ) {
		w3tc_flush_url( $robots_url );
	}
	if ( function_exists( 'w3tc_flush_all' ) ) {
		w3tc_flush_all();
	}

	// Cache Enabler.
	do_action( 'cache_enabler_clear_complete_cache' );

	// Hummingbird.
	do_action( 'wphb_clear_page_cache' );

	// SiteGround Optimizer.
	if ( function_exists( 'sg_cachepress_purge_cache' ) ) {
		sg_cachepress_purge_cache();
	}
	if ( function_exists( 'sg_cachepress_purge_url' ) ) {
		sg_cachepress_purge_url( $robots_url );
	}

	// Nitropack.
	if ( function_exists( 'nitropack_sdk_purge' ) ) {
		nitropack_sdk_purge();
	}

	// Pantheon.
	if ( function_exists( 'pantheon_wp_clear_edge_all' ) ) {
		pantheon_wp_clear_edge_all();
	}

	/**
	 * Fires after Block AI Crawlers requests a page-cache flush.
	 *
	 * Hosts or custom caching layers can hook here to clear robots.txt / HTML caches.
	 *
	 * @param string $robots_url Absolute robots.txt URL.
	 */
	do_action( 'block_ai_crawlers_flushed_caches', $robots_url );
}

/**
 * Registers settings and sections for the Block AI Crawlers plugin.
 */
function block_ai_crawlers_settings() {
	register_setting(
		'block_ai_crawlers_options',
		'block_ai_crawlers_disabled',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'block_ai_crawlers_sanitize_disabled',
			'default'           => array(),
		)
	);

	register_setting( 'block_ai_crawlers_options', 'block_ai_crawlers_custom_robots_txt', array( 'sanitize_callback' => 'block_ai_crawlers_sanitize_robots_txt' ) );

	register_setting(
		'block_ai_crawlers_options',
		'block_ai_crawlers_meta_tag',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'block_ai_crawlers_sanitize_meta_tag',
			'default'           => '1',
		)
	);

	add_settings_section(
		'block_ai_crawlers_robots_section',
		'',
		'block_ai_crawlers_custom_robots_txt_section_callback',
		'block-ai-crawlers-robots'
	);

	add_settings_field(
		'block_ai_crawlers_robots_txt',
		'Robots.txt Content',
		'block_ai_crawlers_custom_robots_txt_field_callback',
		'block-ai-crawlers-robots',
		'block_ai_crawlers_robots_section'
	);
}

/**
 * Sanitizes the list of crawlers opted out of blocking.
 *
 * Expects checked "Block" boxes posted as block_ai_crawlers_blocked[ Name ] = 1.
 * Stores the inverse: known crawlers that were left unchecked.
 *
 * @param mixed $value Unused placeholder from the Settings API hidden field.
 * @return string[]
 */
function block_ai_crawlers_sanitize_disabled( $value ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
	$known = array_keys( block_ai_get_crawlers() );

	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- options.php verifies the Settings API nonce.
	$blocked_input = isset( $_POST['block_ai_crawlers_blocked'] ) ? wp_unslash( $_POST['block_ai_crawlers_blocked'] ) : array();

	if ( ! is_array( $blocked_input ) ) {
		$blocked_input = array();
	}

	$blocked = array();
	foreach ( array_keys( $blocked_input ) as $name ) {
		$name = sanitize_text_field( $name );
		if ( '' !== $name ) {
			$blocked[] = $name;
		}
	}

	$blocked  = array_intersect( $blocked, $known );
	$disabled = array_values( array_diff( $known, $blocked ) );

	return $disabled;
}

/**
 * Sanitizes the meta tag enabled setting.
 *
 * @param mixed $value Submitted option value.
 * @return string '1' or '0'
 */
function block_ai_crawlers_sanitize_meta_tag( $value ) {
	return ( '1' === (string) $value ) ? '1' : '0';
}


/**
 * Sanitizes the custom robots.txt content.
 *
 * @param string|array $value The unsanitized robots.txt content.
 * @return string The sanitized robots.txt content.
 */
function block_ai_crawlers_sanitize_robots_txt( $value ) {
	// Ensure we have a string value.
	if ( is_array( $value ) ) {
		$value = isset( $value[0] ) ? $value[0] : '';
	}

	// Unslash the value (WordPress adds slashes to POST data).
	$value = wp_unslash( $value );

	// Sanitize the textarea content while preserving robots.txt format.
	$sanitized = sanitize_textarea_field( $value );

	return $sanitized;
}

/**
 * Callback function for the custom robots.txt entries section.
 */
function block_ai_crawlers_custom_robots_txt_section_callback() {
	echo '<p>This section can be used to add custom entries to the <code>robots.txt</code> file.</p>';
}

/**
 * Callback function for the robots.txt entries field.
 */
function block_ai_crawlers_custom_robots_txt_field_callback() {
	$robots_txt = get_option( 'block_ai_crawlers_custom_robots_txt', '' );
	echo '<textarea name="block_ai_crawlers_custom_robots_txt" rows="10" cols="50" class="large-text">' . esc_textarea( $robots_txt ) . '</textarea>';
}
