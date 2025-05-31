<?php
/** Display HTML for settings page
 *
 * @package "Block_AI_Crawlers"
 */

?>
<div class="block-ai-container">
	<div class="wrap">
		<h2>Block AI Crawlers</h2>

		<div class="notice notice-info">
			<p><span style="font-size: 3em;">&#128581;</span> <b style="font-size: 1.25em;">You are telling AI bots and crawlers not to index your site.</b></p>
		</div>

		<div class="block-ai-info">
			<p>AI Bots and Crawlers are being automatically blocked via code inserted into your site's <code>robots.txt</code> file. This is a standard way to communicate preferences to web crawlers.</p>
			<p><i>Note:</i> It is up to the AI companies to obey these directions. Unfortunately, there is no guarantee that they will.</p>

			<section>
				<details> 	
					<summary><h3>Blocked Crawlers</h3></summary>

					<?php
					$crawlers = '[
						{"name": "AI2Bot", "description": "Explores sites for web content that is used to train open language models", "link": "https://allenai.org/crawler"},
						{"name": "Ai2Bot-Dolma", "description": "Generates data sets used to train open language models", "link": "https://allenai.org/dolma"},
						{"name": "aiHitBot", "description": "aiHitdata is a artificial intelligence/machine learning system that uses web scraping to collect data for training AI models.", "link": "https://www.aihitdata.com/about/"},
						{"name": "AmazonBot", "description": "Used by Amazon\'s Alexa AI to provide AI answers.", "link": "https://developer.amazon.com/amazonbot"},
						{"name": "AppleBot", "description": "Used by Apple for generative AI features across Apple products, including Apple Intelligence, Services, and Developer Tools.", "link": "https://support.apple.com/en-us/119829"},
						{"name": "Bytespider", "description": "Used by TikTok for AI training.", "link": "https://darkvisitors.com/agents/bytespider"},
						{"name": "ChatGPT", "description": "Used by OpenAI to power ChatGPT.", "link": "https://platform.openai.com/docs/plugins/bot"},
						{"name": "ClaudeBot and Claude-Web", "description": "Used by Anthropic\'s Claude.", "link": "https://support.anthropic.com/en/articles/8896518-does-anthropic-crawl-data-from-the-web-and-how-can-site-owners-block-the-crawler"},
						{"name": "Cohere and cohere-training-data-crawler", "description": "Used by Cohere to scrape data for AI training.", "link": "https://cohere.com/about"},
						{"name": "CommonCrawl", "description": "Compiles datasets used to train AI models.", "link": "https://commoncrawl.org/big-picture/frequently-asked-questions/"},
						{"name": "Cotoyogi", "description": "A Japan-based crawler used to train AI models.", "link": "https://ds.rois.ac.jp/en_center8/en_crawler/"},
						{"name": "Crawlspace", "description": "A web scraper that can be used to extract data for AI training.", "link": "https://crawlspace.dev/"},
						{"name": "Diffbot", "description": "Used by Diffbot to scrape data for AI training.", "link": "https://docs.diffbot.com/reference/crawl-introduction"},
						{"name": "FacebookBot", "description": "Used by Meta (Facebook) for their AI.", "link": "https://developers.facebook.com/docs/sharing/bot"},
						{"name": "Factset_spyderbot", "description": "Used by Factset to scrape data for AI training.", "link": "https://www.factset.com/ai"},
						{"name": "FirecrawlAgent", "description": "Used by Firecrawl to scrape data for AI training.", "link": "https://www.firecrawl.dev/"},
						{"name": "Friendly Crawler", "description": "Crawls websites to build datasets for machine learning experiments.", "link": "https://imho.alex-kunz.com/2024/01/25/an-update-on-friendly-crawler/"},
						{"name": "Google Extended", "description": "Used by Google to power Gemini (formerly known as Bard).", "link": "https://developers.google.com/search/docs/crawling-indexing/overview-google-crawlers?hl=en#common-crawlers"},
						{"name": "ImagesiftBot", "description": "Used by Hive\'s Imagesift tool that scrapes images. This may be used for the company\'s generative AI product.", "link": "https://imagesift.com/about"},
						{"name": "Kangaroo Bot", "description": "Used to power the Australia-focused Kangaroo LLM.", "link": "https://kangaroollm.com.au/kangaroo-bot/"},
						{"name": "Meta-ExternalAgent / Meta-ExternalFetcher", "description": "Used by Meta (Facebook) to train AI products.", "link": "https://developers.facebook.com/docs/sharing/webmasters/web-crawlers"},
						{"name": "OAI-SearchBot", "description": "Used by OpenAI for their SearchGPT product.", "link": "https://platform.openai.com/docs/bots"},
						{"name": "Omgilibot", "description": "Used by Omigili to scrape data for AI training.", "link": "https://webz.io/blog/machine-learning/common-crawl-vs-webz-io-data-which-one-works-best-for-large-language-models/"},
						{"name": "PanguBot", "description": "Used by Huawei to download data for the Large Language Model (LLM) called PanGu.", "link": "https://darkvisitors.com/agents/pangubot"},
						{"name": "PerplexityBot", "description": "Used by Perplexity for their AI products.", "link": "https://docs.perplexity.ai/docs/perplexitybot"},
						{"name": "Perplexity‑User", "description": "Used by Perplexity for their AI products.", "link": "https://perplexity.ai/perplexity-user"},
						{"name": "Scrapy", "description": "Blocks the Scrapy bot (used for scraping websites).", "link": "https://scrapy.org/"},
						{"name": "SemrushBot", "description": "Blocks the Semrush bot used to pull data into the Semrush platform. Data is used for their ContentShake AI tool.", "link": "https://www.semrush.com/bot/"},
						{"name": "TikTokSpider", "description": "Used by Bytedance (TikTok\'s parent company).", "link": ""},
						{"name": "Timpibot", "description": "Used by Timpi; likely for their Wilson AI Product.", "link": "https://timpi.io/wilson-ai/"},
						{"name": "TurnitinBot", "description": "Used by Turnitin to scrape data for plagiarism detection", "link": "https://www.turnitin.com/robot/crawlerinfo.html"},
						{"name": "Webzio", "description": "Used by Webz.io for their social listening and intelligence platforms.", "link": "https://webz.io/bot.html"},
						{"name": "Webzio-Extended", "description": "Used by Webz.io for AI training.", "link": "https://webz.io/bot.html"},
						{"name": "YouBot", "description": "Used by You.com to train AI products.", "link": "https://about.you.com/es/youbot/"}
					]';

					$crawlers_array = json_decode( $crawlers, true );
					?>

					<table class="crawler-table">
						<tbody>
							<?php foreach ( $crawlers_array as $crawler ) : ?>
								<tr>
									<th class="form-table-header"><?php echo esc_html( $crawler['name'] ); ?></th>
									<td><p><?php echo esc_html( $crawler['description'] ); ?></p></td>
									<td><a href="<?php echo esc_url( $crawler['link'] ); ?>" target="_blank">More Info <span class="dashicons dashicons-external link"></span></a></td>
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
