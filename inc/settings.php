<?php
/**
 * Configures settings display in admin view for plugin.
 *
 * @package "Block_AI_Crawlerss"
 */

add_action( 'admin_menu', 'block_ai_crawlers_add_settings_menu' );

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
		'block_ai_crawlers',
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
<div class="wrap">
	<h2>Block AI Crawlers</h2>
	<hr>
	<div class="notice notice-info"><p><span style="font-size: 3em;">&#128581;</span> <b style="font-size: 1.25em;">Your site is telling AI bots and crawlers not to index your site.</b></p></div>
	<div  style="background-color: #fff; padding: 25px; margin-top: 15px; border: 1px solid #c3c4c7;">
	<p>The following are being blocked. These are being automatically inserted into your site's `robots.txt` file. `robots.txt` is a standardized way of controlling crawler behavior.</p>

	<section>
		<h3>Blocked Crawlers</h3>
		<table class="form-table" style="background-color: #fff; border: 1px solid #eee;">
			<tbody>
				<tr style="padding: 10px; border-bottom: 1px solid #eee;">
					<th scope="row" style="padding: 10px;">ChatGPT</th>
					<td><p class="description">test test test</p></td>
				</tr>
				<tr style="padding: 10px; border-bottom: 1px solid #eee;">
					<th scope="row" style="padding: 10px;">ChatGPT</th>
					<td><p class="description">test test test</p></td>
				</tr>
			</tbody>
		</table>

		<table><tr><th>ChatGPT</th><td>Test</td></tr></table>
		<h4>ChatGPT</h4>
	</section>

	<section>
		<h3>Experimental Meta Tags</h3>
		<p>The “noai, noimageai” directive to your site’s meta tags. These tags tell AI bots not to use your content as part of their data sets. These are experimental and they have not been standardized.</p>
	</section>

	<section>
		<h3>Leave a Review</h3>
		<p>Do you find this plugin useful? If so, please leave a review on WordPress.org. Reviews help increase the visibility.</p>
	</section>
	</div>
</div>
<? }
