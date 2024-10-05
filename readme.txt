=== Block AI Crawlers ===
Contributors: lastsplash
Tags: ai, robots.txt, chatgpt, crawlers
Requires at least: 5.6
Tested up to: 6.6.2
Requires PHP: 7.4
Stable tag: 1.4.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Tells AI companies not to access and scrape your site for AI.

== Description ==

Tells AI crawlers (such as OpenAI ChatGPT) not to use your website as training data for their Artificial Intelligence (AI) products. It does this by updating your site's `robots.txt` to block common AI crawlers and scrapers. This should prevent your content from being used to traing Large Language Models (LLMs). 

It blocks these AI crawlers and bots:

- **ChatGPT and GPTBot** - Crawlers and web browser used by OpenAI
- **Google Extended** - Crawler used for Google's Gemini (formerly Google Bard) AI training
- **FacebookBot** - Crawler used for Facebook's AI training
- **Meta** - Blocks crawlers used by Meta AI training
- **CommonCrawl** - Crawler that compiles datasets used to train AI models
- **Anthropic AI / Claude** - Crawler used by Anthropic
- **Omgili** - Crawler used by Omgili for AI training
- **Bytespider** - Crawler used by TikTok for AI training 
- **PerplexityBot** - Used by Perplexity for its AI products
- **Applebot** - Used by Apple to train its AI products
- **Cohere** - Crawler used by Cohere AI training 
- **DiffBot** - Crawler used by Diffbot for AI training 
- **Imagesift** - Crawler used by used by Imagesift for images 
- ... and more!

## Experimental Meta Tags

The plugin adds the "noai, noimageai" directive to your site's meta tags. These tags tell AI bots not to use your content as part of their data sets. These are experimental and they have not been standardized. 

## Disclaimer

*Note:* While the plugin adds these markers, it is up to the crawlers themeselves to honor these requests.

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress
2. Once installed the plugin is automatically activated. There are no user configured settings
3. You can view more about what crawlers are being blocked at "Settings > Block AI Crawlers"

== Frequently Asked Questions ==

= Will this remove my site from existing data sets? =

Unfortunately, no. However, it does tell bots that your site shouldn't be used for future datasets.

= How does this work? =

The plugin adds directives to the `robots.txt` file to tell AI crawlers that they shouldn't index your site. It also adds the `noai` meta tag to your site's header to do the same.

= What if I already have a `robots.txt` file on my web server? =

If you have a physical `robots.txt` file on your web server, you won't be able to activate this plugin. The plugin only works when using WordPress' built-in virtual `robots.txt`.

= Will this work with other plugins that modify the virtual `robots.txt`? =

It should in theory. It just appends the directives to the `robots.txt` file.

= Will this prevent my site from being indexed by search engines? =

No. Search engines follow different `robots.txt` rules.

== Screenshots ==


== Changelog ==

= 1.4.0 =
- New: Block sentibot
- New: Block FriendlyCrawler
- New: Block Scrapy
- Fix: Broken link to settings page from Plugins page

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