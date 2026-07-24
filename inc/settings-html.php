<?php
/** Display HTML for settings page
 *
 * @package "Block_AI_Crawlers"
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$block_ai_crawlers_array    = function_exists( 'block_ai_get_crawlers' ) ? block_ai_get_crawlers() : array();
$block_ai_crawlers_disabled = function_exists( 'block_ai_get_disabled_crawlers' ) ? block_ai_get_disabled_crawlers() : array();

?>
<div class="block-ai-container">
	<div class="wrap">
		<h2>Block AI Crawlers</h2>

		<div class="notice notice-info">
			<p><span style="font-size: 3em;">&#128581;</span> <b style="font-size: 1.25em;">You are telling AI bots and crawlers not to index your site.</b></p>
		</div>

		<div class="block-ai-info">
			<p>AI Bots and Crawlers are being automatically blocked via code inserted into your site's <code>robots.txt</code> file. This is a standard way to communicate preferences to web crawlers.</p>
			<p>The blocked crawler list is generated from the <a href="https://github.com/ai-robots-txt/ai.robots.txt" target="_blank" rel="noopener noreferrer">ai.robots.txt</a> project. When that upstream list changes, the plugin will be rebuilt and released.</p>
			<p><i>Note:</i> It is up to the AI companies to obey these directions. Unfortunately, there is no guarantee that they will.</p>

			<form method="post" action="options.php">
				<?php settings_fields( 'block_ai_crawlers_options' ); ?>
				<input type="hidden" name="block_ai_crawlers_disabled" value="1" />

				<section>
					<details>
						<summary><h3>Blocked Crawlers</h3></summary>

						<p>Uncheck a crawler to stop adding a <code>Disallow</code> rule for it in <code>robots.txt</code>. New crawlers added in plugin updates remain blocked by default.</p>

						<div class="crawler-table-wrap">
							<table class="crawler-table">
								<thead>
									<tr>
										<th class="crawler-toggle" scope="col">Block</th>
										<th scope="col">Crawler</th>
										<th scope="col">Description</th>
										<th class="crawler-link" scope="col"><span class="screen-reader-text">More info</span></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $block_ai_crawlers_array as $block_ai_crawler_name => $block_ai_crawler ) : ?>
										<?php
										$block_ai_is_blocked = ! in_array( $block_ai_crawler_name, $block_ai_crawlers_disabled, true );
										$block_ai_field_id   = 'block-ai-crawler-' . sanitize_title( $block_ai_crawler_name );
										?>
										<tr>
											<td class="crawler-toggle">
												<input
													type="checkbox"
													id="<?php echo esc_attr( $block_ai_field_id ); ?>"
													name="block_ai_crawlers_blocked[<?php echo esc_attr( $block_ai_crawler_name ); ?>]"
													value="1"
													<?php checked( $block_ai_is_blocked ); ?>
												/>
											</td>
											<th class="form-table-header" scope="row">
												<label for="<?php echo esc_attr( $block_ai_field_id ); ?>"><?php echo esc_html( $block_ai_crawler_name ); ?></label>
											</th>
											<td class="crawler-description"><p><?php echo esc_html( $block_ai_crawler['description'] ); ?></p></td>
											<td class="crawler-link">
												<?php if ( ! empty( $block_ai_crawler['link'] ) ) : ?>
													<a href="<?php echo esc_url( $block_ai_crawler['link'] ); ?>" target="_blank" rel="noopener noreferrer" title="More Info"> Info <span class="dashicons dashicons-external link"></span></a>
												<?php else : ?>
													<span aria-hidden="true">&mdash;</span>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

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
						<?php do_settings_sections( 'block-ai-crawlers-robots' ); ?>
					</details>
				</section>

				<?php submit_button(); ?>
			</form>

			<section>
				<h3>Leave a Review</h3>
				<hr>
				<p>Do you find this plugin useful? If so, please <a href="https://wordpress.org/support/plugin/block-ai-crawlers/reviews/?new-post">leave a review on WordPress.org</a>. Reviews help increase the visibility.</p>
			</section>
		</div>
	</div>
</div>
