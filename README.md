# Block AI Crawlers

This WordPress plugin helps prevent AI crawlers from using your content as training data for their products. By updating your site's `robots.txt`, it blocks common AI crawlers and scrapers, aiming to protect your content from being used in the training of Large Language Models (LLMs).

## Features

### Blocks AI Crawlers

Includes:

- **OpenAI** - Blocks crawlers used for ChatGPT
- **Google** - Blocks crawlers used by Google's Gemini AI products
- **Meta** - Blocks FacebookBot and Meta training crawlers
- **Anthropic** - Blocks crawlers used by Claude
- **Perplexity** - Blocks crawlers used by Perplexity
- **Apple** - Blocks Applebot-Extended
- **Amazon** - Blocks Amazonbot
- ...and 150+ more via ai.robots.txt

The blocked crawler list is generated at build time from
[ai.robots.txt](https://github.com/ai-robots-txt/ai.robots.txt) (`robots.json`, MIT).

### Experimental Meta Tags

The plugin adds the "noai, noimageai" directive to your site's meta tags, instructing AI bots not to use your content in their datasets. Please note that these tags are experimental and have not been standardized.

## Installation

1. Download the plugin zip file.
2. Go to your WordPress admin panel.
3. Navigate to Plugins > Add New > Upload Plugin.
4. Choose the zip file and click "Install Now."
5. Activate the plugin.



## Usage

After activation, the plugin will automatically update your `robots.txt` and add the necessary meta tags. No further configuration is required, but you can check the settings page for a full list of blocked crawlers.

## Updating the crawler list (developers)

To refresh the committed crawler data from upstream:

```bash
php bin/import-robots.php
```

This writes `inc/generated/crawlers.php`. Commit the regenerated file before releasing.

See [THIRD-PARTY.md](THIRD-PARTY.md) for license attribution.

## Limitations

While this plugin aims to block specified crawlers, it cannot guarantee complete protection against all forms of scraping, as some bots may disregard `robots.txt` directives.

## Support

For questions or support, [please post on the forums](https://wordpress.org/support/plugin/block-ai-crawlers/) or [on GitHub](https://github.com/bobmatyas/wp-block-ai-crawlers/issues).

# Third-Party Notices

## ai.robots.txt

The built-in blocked crawler list is derived from [ai.robots.txt](https://github.com/ai-robots-txt/ai.robots.txt) (`robots.json`), maintained by the ai.robots.txt project.

MIT License

Copyright (c) 2024 ai.robots.txt

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.