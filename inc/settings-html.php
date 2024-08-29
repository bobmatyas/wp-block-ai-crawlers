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
					<table class="form-table">
						<tbody>
							<tr>
								<th>AmazonBot</th>
								<td><p>Used by Amazon's Alexa AI to provide AI answers.</p></td>
								<td><a href="https://developer.amazon.com/amazonbot" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>AppleBot</th>
								<td><p>Used by Apple for generative AI features across Apple products, including Apple Intelligence, Services, and Developer Tools.</p></td>
								<td><a href="https://support.apple.com/en-us/119829" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Bytespider</th>
								<td><p>Used by TikTok for AI training</p></td>
								<td><a href="https://darkvisitors.com/agents/bytespider" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Cohere</th>
								<td><p>Used by Cohere to scrape data for AI training</p></td>
								<td><a href="https://darkvisitors.com/agents/cohere-ai" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>ChatGPT</th>
								<td><p>Used by OpenAI</p></td>
								<td><a href="https://platform.openai.com/docs/plugins/bot" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>ClaudeBot and Claude-Web</th>
								<td><p>Used by Anthropic's Claude</p></td>
								<td><a href="https://support.anthropic.com/en/articles/8896518-does-anthropic-crawl-data-from-the-web-and-how-can-site-owners-block-the-crawler" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>CommonCrawl</th>
								<td><p>Compiles datasets used to train AI models</p></td>
								<td><a href="https://commoncrawl.org/big-picture/frequently-asked-questions/" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Diffbot</th>
								<td><p>Used by Diffbot to scrape data for AI training</p></td>
								<td><a href="https://docs.diffbot.com/reference/crawl-introduction" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>FacebookBot</th>
								<td><p>Used by Meta (Facebook) for their AI</p></td>
								<td><a href="https://developers.facebook.com/docs/sharing/bot" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Google Extended</th>
								<td><p>Used by Google to power Gemini (formerly known as Bard)</p></td>
								<td><a href="https://developers.google.com/search/docs/crawling-indexing/overview-google-crawlers?hl=en#common-crawlers" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>ImagesiftBot</th>
								<td><p>Used by Hive's Imagesift tool that scrapes images. This may be used for the company's generative AI product </p></td>
								<td><a href="https://imagesift.com/about" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Meta-ExternalAgent / Meta-ExternalFetcher</th>
								<td><p>Used by Meta to train AI products</p></td>
								<td><a href="https://developers.facebook.com/docs/sharing/webmasters/web-crawlers" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>OAI-SearchBot</th>
								<td><p>Used by OpenAI for their SearchGPT product.</p></td>
								<td><a href="https://platform.openai.com/docs/bots" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Omgilibot</th>
								<td><p>Used by Omigili to scrape data for AI training</p></td>
								<td><a href="https://webz.io/blog/machine-learning/common-crawl-vs-webz-io-data-which-one-works-best-for-large-language-models/" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>PerplexityBot</th>
								<td><p>Used by Perplexity for their AI products</p></td>
								<td><a href="https://docs.perplexity.ai/docs/perplexitybot" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Timpibot</th>
								<td><p>Used by Timpi; likely for their Wilson AI Product.</p></td>
								<td><a href="https://timpi.io/wilson-ai/" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Webzio</th>
								<td><p>Used by Webz.io for their social listening and intelligence platforms.</p></td>
								<td><a href="https://webz.io/bot.html" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>Webzio-Extended</th>
								<td><p>Used by Webz.io for AI training.</p></td>
								<td><a href="https://webz.io/bot.html" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
							</tr>
							<tr>
								<th>YouBot</th>
								<td><p>Used by You.com to train AI products.</p></td>
								<td><a href="https://about.you.com/es/youbot/" target=_blank>More Info <span class="dashicons dashicons-external link"></span></a></td>
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
