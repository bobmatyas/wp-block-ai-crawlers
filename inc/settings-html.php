<?php
/** Display HTML for settings page
 *
 * @package "Block_AI_Crawlers"
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="block-ai-container">
	<div class="wrap">
		<h2>Block AI Crawlers</h2>

		<div class="notice notice-info">
			<p><span style="font-size: 3em;">&#128581;</span> <b style="font-size: 1.25em;">You are telling AI bots and crawlers not to index your site.</b></p>
		</div>

		<div class="block-ai-info">
			<p>AI Bots and Crawlers are being automatically blocked via code inserted into your site's <code>robots.txt</code> file. This is a standard way to communicate preferences to web crawlers.</p>
			<p>The blocked crawler list is generated from the <a href="https://github.com/ai-robots-txt/ai.robots.txt" target="_blank">ai.robots.txt</a> project. When that upstream list changes, the plugin will be rebuilt and released.</p>
			<p><i>Note:</i> It is up to the AI companies to obey these directions. Unfortunately, there is no guarantee that they will.</p>

			<section>
				<details> 	
					<summary><h3>Blocked Crawlers</h3></summary>

					<?php
					$block_ai_crawlers_array = function_exists( 'block_ai_get_crawlers' ) ? block_ai_get_crawlers() : array();
					?>

					<table class="crawler-table">
						<tbody>
							<?php foreach ( $block_ai_crawlers_array as $block_ai_crawler_name => $block_ai_crawler ) : ?>
								<tr>
									<th class="form-table-header"><?php echo esc_html( $block_ai_crawler_name ); ?></th>
									<td class="crawler-description"><p><?php echo esc_html( $block_ai_crawler['description'] ); ?></p></td>
									<td class="crawler-link">
									<a href="<?php echo esc_url( $block_ai_crawler['link'] ); ?>" target="_blank" rel="noopener noreferrer" title="More Info"> Info <span class="dashicons dashicons-external link"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
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
				<details>
					<summary><h3>Custom Robots.txt Entries</h3></summary>
					<form method="post" action="options.php">
						<?php
							settings_fields( 'block_ai_crawlers_options' );
							do_settings_sections( 'block-ai-crawlers-robots' );
						?>

						<?php submit_button(); ?>
					</form>
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
