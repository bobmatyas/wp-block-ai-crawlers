=== Block AI Crawlers ===
Contributors: lastsplash
Tags: ai, robots.txt, chatgpt, crawlers
Requires at least: 5.6
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.5.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Tell AI (Artificial Intelligence) companies not to scrape your site for their AI products.

== Description ==

# Protect Your Content from AI Scraping

This plugin helps you prevent AI crawlers from using your content as training data for their products. By updating your site's `robots.txt`, it blocks common AI crawlers and scrapers, aiming to protect your content from being used in the training of Large Language Models (LLMs).

## Features

### Blocks AI Crawlers

Includes:

  - **OpenAI** - Blocks crawlers used for ChatGPT
  - **Google** - Blocks crawlers used by Google's Gemini AI products
  - **Facebook / Meta** - Used for Facebook's AI training
  - **Anthropic AI** - Blocks crawlers used by Anthropic  
  - **Perplexity** - Block crawlers used by Perplexity
  - **Applebot** - Blocks crawlers used by Apple
  - ... and more!

### Experimental Meta Tags

The plugin adds the "noai, noimageai" directive to your site's meta tags, instructing AI bots not to use your content in their datasets. Please note that these tags are experimental and have not been standardized.

### Custom robots.txt Rules

Have custom entries for your robots.txt file? You can now add them directly through the plugin!

## Installation

1. Download the plugin zip file.
2. Go to your WordPress admin panel.
3. Navigate to Plugins > Add New > Upload Plugin.
4. Choose the zip file and click "Install Now."
5. Activate the plugin.

## Usage

After activation, the plugin will automatically update your `robots.txt` and add the necessary meta tags. No further configuration is required, but you can check the settings page for a full list of blocked crawlers.

## Limitations

While this plugin aims to block specified crawlers, it cannot guarantee complete protection against all forms of scraping, as some bots may disregard `robots.txt` directives.

## Support

For questions or support, [please post on the forums](https://wordpress.org/support/plugin/block-ai-crawlers/) or [on GitHub](https://github.com/bobmatyas/wp-block-ai-crawlers/issues).

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress
2. Once installed the plugin is automatically activated. There are no user configured settings
3. You can view more about what crawlers are being blocked at "Settings > Block AI Crawlers"

== Frequently Asked Questions ==

= Will this remove my site from existing data sets? =

Unfortunately, no. However, it does tell bots that your site shouldn't be used for future datasets.

= How does this work? =

The plugin adds directives to the `robots.txt` file to tell AI crawlers that they shouldn't index your site. It also adds the `noai` meta tag to your site's header to do the same.

= How often is this updated? =

I try to keep up with new crawlers and update the block list regularly.

= Can I suggest crawlers for blocking? =

Yes! please share suggestions on [the forums](https://wordpress.org/support/plugin/block-ai-crawlers/) or [on GitHub](https://github.com/bobmatyas/wp-block-ai-crawlers/issues).

= What if I already have a `robots.txt` file on my web server? =

If you have a physical `robots.txt` file on your web server, you won't be able to activate this plugin. The plugin only works when using WordPress' built-in virtual `robots.txt`.

= Will this work with other plugins that modify the virtual `robots.txt`? =

It should in theory. It just appends the directives to the `robots.txt` file.

= Will this prevent my site from being indexed by search engines? =

No. Search engines follow different `robots.txt` rules.

== Screenshots ==


== Changelog ==

= 1.5.2 =
- New: Block Yak
- New: Block Bigsur.ai
- New: Block AddSearchBot
- New: Block Google Agents
- New: Block Thinkbot
- New: Block Posideon Research Center
- New: Block EchoboxBot
- New: Block Bedrockbot
- New: Block Panscient
- New: Block SBIntuitionsBot
- New: Block PhindBot
- New: Block YandexAdditional

= 1.5.1 =
- New: Block aiHitBot
- New: Block Cotoyogi
- New: Block Factset
- New: Block Firecrawl
- New: Block TikTokSpider
- New: Block Perplexity‑User
- Update: Meta External Agent and Meta External Fetcher
- Update: New Claude Bots
- Update: Indicate WordPress v6.8 compatibility

= 1.5.0 =
- Enhancement: Adds ability for custom robots.txt rules

= 1.4.3 =
- New: Block SemrushBot
- New: Block Crawlspace

= 1.4.2 =
- New: Block PanguBot

= 1.4.1 =
- New: Block Turnitinbot
- New: Block Ai2Bot-Dolma
- Enhancement: WordPress 6.7 compatibility

= 1.4.0 =
- New: Block Kangaroo Bot
- New: Block sentibot
- New: Block FriendlyCrawler
- New: Block Scrapy
- Fix: Broken link to settings page from Plugins page
- Enhancement: Improve `readme.md` and `readme.txt`

= 1.3.9 =
- New: Block PetalBot
- New: Block AI2Bot
- New: Block Webz.io
- New: Block OpenAI Search Bot (SearchGPT)
- Enhancement: Alphabetize list of blocked crawlers
- Enhancement: Indicate compatibility with WordPress v6.6
- Enhancement: Add quick link to settings and nudge for rating on plugins page

= 1.3.8 =
- Maintenance: Auto-deply from Github fixed / bumped version number

= 1.3.7 =
- New: Meta AI
- New: Block You.com Crawler
- New: Block AmazonBot
- New: Block Timpibot

= 1.3.6 =
- New: Block Perplexity
- New: Block Apple AI
- Update: FAQ based on submitted question

= 1.3.5 =
- New: Block additional Omgili bot
- New: Block Imagesift
- Fix: Fix settings page
- Add: `blueprint.json` for plugin preview

= 1.3.3 =
- Fix: Issue with fatal errors on activation

= 1.3.1 =
- New: Blocks Anthropic's Claude
- Fix: Missing external link icons
- Update: Bump tested to v6.5.3

= 1.3.0 =
- New: Adds settings page showing blocked crawlers
- Enhancement: Remove crawler description in `robots.txt`

= 1.2.2 =
- Update: Adds deploy from GitHub

= 1.2.1 =
- Maintenance: Adds deploy from GitHub

= 1.2.0 =
- Block Cohere crawler
- Block DiffBot crawler
- Block Anthropic AI crawler
- Indicate compatibility w/WordPress 6.5.2

= 1.1.0 =
- Blocks additional crawlers.

= 1.0.0 =
Initial Release.

== Screenshots ==

1. Plugin page showing which crawlers are blocked