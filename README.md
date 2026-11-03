# Legacy MP3 Remote Embeds for WordPress

A lightweight WordPress plugin designed to seamlessly render legacy Joomla audio tags (`{mp3remote}...{/mp3remote}` or just `{mp3}...{/mp3}`) as native WordPress audio players—**without requiring any database modifications or manual post editing.**

## Overview

When migrating content from Joomla to WordPress (often utilizing legacy extensions like *AllVideo Share* or similar *AllVideos* plugins), articles frequently contain custom template tags that WordPress does not recognize out of the box. 

Instead of leaving broken text or forcing you to run complex database search-and-replace queries across thousands of migrated posts, this plugin dynamically intercepts the content during rendering and converts legacy tags into standard WordPress Gutenberg audio blocks.

## Features

- **Zero Database Changes:** Keeps your imported post content clean and untouched; tags are parsed dynamically on the fly.
- **Native Gutenberg Integration:** Outputs standard WordPress audio block markup (`<!-- wp:audio -->`) so the players integrate smoothly with your theme styling.
- **Universal View Support:** Works seamlessly across single post views, homepages, category archives, and blog list loops.
- **Secure URL Sanitization:** Cleans and validates remote URLs safely using built-in WordPress security functions (`esc_url()`).

## Example Syntax

### Legacy Joomla Tag (In Post Content):
```text
{mp3remote}/some/path/to/your.mp3{/mp3remote}
