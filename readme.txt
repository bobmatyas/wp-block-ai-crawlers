=== Block AI Crawlers ===
Contributors: lastsplash
Tags: ai, robots.txt, chatgpt, crawlers
Requires at least: 5.6
Tested up to: 6.5.2
Requires PHP: 5.6
Stable tag: 1.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Tell AI crawlers that they shouldn't access your site.

== Description ==

This plugin tells AI crawlers not to index your site. 

It uses `robots.txt` to tell the following crawlers not to index your site:

- **ChatGPT and GPTBot** - Crawlers and web browser used by OpenAI
- **Google Extended** - Crawler used for Google's Gemini (formerly Google Bard) AI training
- **FacebookBot** - Crawler used for Facebook's AI training
- **CommonCrawl** - Crawler that compiles datasets used to train AI models
- **Anthropic AI** - Crawler used by Anthropic
- **Omgili** - Crawler used by Omgili for AI training
- **Bytespider** - Crawler used by TikTolk for AI training 

Additionally, the plugin adds the "noai, noimageai" directive to your site's meta tags. These signals tell AI bots not to use your content as part of their data sets.

*Note:* While the plugin adds these markers, it is up to the crawlers themeselves to honor these requests.

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How does this work? =

The plugin adds directives to the `robots.txt` file to tell AI crawlers that they shouldn't index your site. It also adds the `noai` meta tag to your site's header to do the same.

= What if I already have a `robots.txt` file on my web server? =

If you have a physical `robots.txt` file on your web server, you won't be able to activate this plugin. The plugin only works when using WordPress' built-in virtual `robots.txt`.

= Will this work with other plugins that modify the virtual `robots.txt`? =

It should in theory. It just appends the directives to the `robots.txt` file.

= Will this remove my site from existing data sets? =

Unfortunately, no. However, it does tell bots that your site shouldn't be included in the future.

== Screenshots ==


== Changelog ==

= 1.2.0 =
- Block Cohere crawler
- Block DiffBot crawler
- Block Anthropic AI crawler
- Indicate compatibility w/WordPress 6.5.2

= 1.1.0 =
- Blocks additional crawlers.

= 1.0.0 =
Initial Release.