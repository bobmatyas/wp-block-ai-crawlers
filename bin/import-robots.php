#!/usr/bin/env php
<?php
/**
 * Build script: import crawlers from ai.robots.txt robots.json.
 *
 * Usage:
 *   php bin/import-robots.php
 *   php bin/import-robots.php /path/to/local/robots.json
 *
 * @package Block_AI_Crawlers
 */

if ( PHP_SAPI !== 'cli' ) {
	fwrite( STDERR, "This script must be run from the command line.\n" );
	exit( 1 );
}

$plugin_root = dirname( __DIR__ );
$output_path = $plugin_root . '/inc/generated/crawlers.php';
$json_url    = 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/main/robots.json';
$api_url     = 'https://api.github.com/repos/ai-robots-txt/ai.robots.txt/contents/robots.json';

$local_json = isset( $argv[1] ) ? $argv[1] : null;

/**
 * Fetch a URL and return the body, or exit on failure.
 *
 * @param string $url     URL to fetch.
 * @param array  $headers Optional HTTP headers.
 * @return string
 */
function block_ai_import_fetch( $url, $headers = array() ) {
	$default_headers = array( 'User-Agent: block-ai-crawlers-import/1.0' );
	$all_headers     = array_merge( $default_headers, $headers );

	if ( function_exists( 'curl_init' ) ) {
		$ch = curl_init( $url );
		curl_setopt_array(
			$ch,
			array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTPHEADER     => $all_headers,
			)
		);
		$body     = curl_exec( $ch );
		$httpcode = (int) curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		$error    = curl_error( $ch );
		curl_close( $ch );

		if ( false === $body || $httpcode < 200 || $httpcode >= 300 ) {
			fwrite( STDERR, "Failed to fetch {$url}" . ( $error ? ": {$error}" : " (HTTP {$httpcode})" ) . "\n" );
			exit( 1 );
		}

		return $body;
	}

	$context = stream_context_create(
		array(
			'http' => array(
				'header'        => implode( "\r\n", $all_headers ) . "\r\n",
				'timeout'       => 30,
				'ignore_errors' => true,
			),
		)
	);

	$body = file_get_contents( $url, false, $context );
	if ( false === $body ) {
		fwrite( STDERR, "Failed to fetch {$url}\n" );
		exit( 1 );
	}

	return $body;
}

/**
 * Extract a URL for the admin Info link from operator/description fields.
 *
 * @param string $operator    Operator field (may contain markdown link).
 * @param string $description Description field (may contain a bare URL).
 * @return string
 */
function block_ai_import_extract_link( $operator, $description ) {
	if ( preg_match( '/\[.*?\]\((https?:\/\/[^\s)]+)\)/', $operator, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '/(https?:\/\/[^\s\]\>\"\']+)/', $description, $matches ) ) {
		return rtrim( $matches[1], '.,);' );
	}

	return '';
}

/**
 * Escape a string for inclusion in a single-quoted PHP string.
 *
 * @param string $value Raw string.
 * @return string
 */
function block_ai_import_php_escape( $value ) {
	return str_replace( array( '\\', "'" ), array( '\\\\', "\\'" ), $value );
}

// Load JSON.
if ( null !== $local_json ) {
	if ( ! is_readable( $local_json ) ) {
		fwrite( STDERR, "Local JSON file not readable: {$local_json}\n" );
		exit( 1 );
	}
	$json_body   = file_get_contents( $local_json );
	$upstream_sha = 'local';
	echo "Using local JSON: {$local_json}\n";
} else {
	echo "Fetching {$json_url}\n";
	$json_body = block_ai_import_fetch( $json_url );

	echo "Resolving upstream blob SHA\n";
	$api_body = block_ai_import_fetch(
		$api_url,
		array( 'Accept: application/vnd.github+json' )
	);
	$api_data = json_decode( $api_body, true );
	if ( ! is_array( $api_data ) || empty( $api_data['sha'] ) ) {
		fwrite( STDERR, "Could not resolve upstream blob SHA from GitHub API.\n" );
		exit( 1 );
	}
	$upstream_sha = $api_data['sha'];
}

$robots = json_decode( $json_body, true );
if ( ! is_array( $robots ) || empty( $robots ) ) {
	fwrite( STDERR, "Failed to parse robots.json or list is empty.\n" );
	exit( 1 );
}

ksort( $robots, SORT_STRING | SORT_FLAG_CASE );

$crawlers = array();
foreach ( $robots as $name => $meta ) {
	if ( ! is_string( $name ) || '' === $name || ! is_array( $meta ) ) {
		continue;
	}

	$description = isset( $meta['description'] ) && is_string( $meta['description'] )
		? $meta['description']
		: '';
	$operator    = isset( $meta['operator'] ) && is_string( $meta['operator'] )
		? $meta['operator']
		: '';

	$crawlers[ $name ] = array(
		'description' => $description,
		'link'        => block_ai_import_extract_link( $operator, $description ),
	);
}

if ( empty( $crawlers ) ) {
	fwrite( STDERR, "No crawlers extracted from robots.json.\n" );
	exit( 1 );
}

$out  = "<?php\n";
$out .= "/**\n";
$out .= " * Auto-generated from ai.robots.txt robots.json. Do not edit.\n";
$out .= " * Upstream-SHA: {$upstream_sha}\n";
$out .= " * Source: https://github.com/ai-robots-txt/ai.robots.txt\n";
$out .= " *\n";
$out .= " * @package Block_AI_Crawlers\n";
$out .= " */\n\n";
$out .= "return array(\n";

foreach ( $crawlers as $name => $meta ) {
	$out .= "\t'" . block_ai_import_php_escape( $name ) . "' => array(\n";
	$out .= "\t\t'description' => '" . block_ai_import_php_escape( $meta['description'] ) . "',\n";
	$out .= "\t\t'link'        => '" . block_ai_import_php_escape( $meta['link'] ) . "',\n";
	$out .= "\t),\n";
}

$out .= ");\n";

$output_dir = dirname( $output_path );
if ( ! is_dir( $output_dir ) && ! mkdir( $output_dir, 0755, true ) ) {
	fwrite( STDERR, "Failed to create directory: {$output_dir}\n" );
	exit( 1 );
}

if ( false === file_put_contents( $output_path, $out ) ) {
	fwrite( STDERR, "Failed to write {$output_path}\n" );
	exit( 1 );
}

$count = count( $crawlers );
echo "Wrote {$count} crawlers to {$output_path}\n";
echo "Upstream-SHA: {$upstream_sha}\n";
exit( 0 );
