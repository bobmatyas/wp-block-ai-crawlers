<?php
/**
 * Configures settings display in admin view for plugin.
 *
 * @package "Block_AI_Crawlerss"
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
 * Configures options page
 *
 * @return void
 */
function block_ai_crawlers_option_page() {
?>
	<div class="block-ai-container">

<div class="wrap">
	<h2>Block AI Crawlers</h2>
	<div class="notice notice-info"><p><span style="font-size: 3em;">&#128581;</span> <b style="font-size: 1.25em;">You are telling AI bots and crawlers not to index your site.</b></p></div>
	<div class="block-ai-info">
	<p>AI Bots and Crawlers are being automatically blocked via code inserted into your site's <code>robots.txt</code> file. This is a standard way to communicate preferences to web crawlers.</p>
	<p><i>Note:</i> It is up to the AI companies to obey these directions. Unfortunately, there is no guarantee that they will.</p>
	<section>
		<details open> 
		<summary><h3>Blocked Crawlers</h3></summary>
		<table class="form-table">
			<tbody>
				<tr>
					<th>ChatGPT</th>
					<td><p>Used by OpenAI</p></td>
				</tr>
				<tr>
					<th>GPTBot</th>
					<td><p>Used by OpenAI to allow ChatGPT to access the web</p></td>
				</tr>
				<tr>
					<th>Google Extended</th>
					<td><p>Used by Google to power Gemini (formerly known as Bard)</p></td>
				</tr>
				<tr>
					<th>FacebookBot </th>
					<td><p>Used by Meta (Facebook) for their AI</p></td>
				</tr>
				<tr>
					<th>CommonCrawl</th>
					<td><p>Compiles datasets used to train AI models</p></td>
				</tr>
				<tr>
					<th>AnthropicAI</th>
					<td><p>Used by Anthropic</p></td>
				</tr>
				<tr>
					<th>Bytespider</th>
					<td><p>Used by TikTok for AI training</p></td>
				</tr>
				<tr>
					<th>Omgilibot</th>
					<td><p>Used by Omigili to scrape data for AI training</p></td>
				</tr>
				<tr>
					<th>Cohere</th>
					<td><p>Used by Cohere to scrape data for AI training</p></td>
				</tr>
				<tr>
					<th>Diffbot</th>
					<td><p>Used by Diffbot to scrape data for AI training</p></td>
				</tr>
			</tbody>
		</table>
</details>
	</section>

	<section>
		<details>
		<summary><h3>Experimental Meta Tags</h3></summary>
		<p>The <code>"noai, noimageai"</code> directive has been added to your site's meta tags. Meta Tags are standardized, but this directive is experimental.</p>
</details>
	</section>

	<section>
		<h3>Leave a Review</h3>
		<hr>
		<p>Do you find this plugin useful? If so, please <a href="https://wordpress.org/support/plugin/block-ai-crawlers/reviews/?new-post">leave a review on WordPress.org</a>. Reviews help increase the visibility.</p>
	</section>
	</div>
	</div>
</div>
<? }
