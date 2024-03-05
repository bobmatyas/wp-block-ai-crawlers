=== Block AI Crawlers ===
Contributors: lastsplash
Tags: ai, chatgpt, ai crawlers
Requires at least: 5.6
Tested up to: 6.4
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Tell AI crawlers that they shouldn't access your site.

== Description ==

This plugin blocks AI crawlers and bots from ChatGPT and Common Crawl. It uses methods recognized by OpenAI and Common Crawl to block via your site's `robots.txt` file. It adds the "noai, noimageai" directive to your site's meta tags. These signals tell AI bots not to use your content as part of their data sets.

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

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.0 =
Initial Release.