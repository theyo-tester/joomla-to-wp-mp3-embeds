<?php
/**
 * Plugin Name: Joomla to WP MP3 Embeds
 * Plugin URI:  https://github.com/your-username/joomla-to-wp-mp3-embeds
 * Description: Renders legacy Joomla {mp3}...{/mp3} and {mp3remote}...{/mp3remote} tags as native WordPress audio blocks.
 * Version:     1.2.0
 * Author:      teoli
 * Author URI:  https://github.com/theyo-tester
 * Text Domain: joomla-to-wp-mp3-embeds
 */

add_filter( 'the_content', 'mysite_render_legacy_mp3_embeds', 8 );

function mysite_render_legacy_mp3_embeds( $content ) {
    // Allow single posts/pages, the blog homepage, and archives, but stay within the main query loop.
    if ( ! ( is_singular() || is_home() || is_archive() ) || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }

    // Matches both {mp3}...{/mp3} and {mp3remote}...{/mp3remote}
    return preg_replace_callback(
        '~\{(mp3|mp3remote)\}(.*?)\{\/\1\}~is',
        'mysite_render_one_legacy_mp3_embed',
        $content
    );
}

function mysite_render_one_legacy_mp3_embed( $matches ) {
    // $matches[1] contains the tag type (mp3 or mp3remote)
    // $matches[2] contains the file path or URL inside the tags
    $url = trim( $matches[2] );

    // Sanitize the URL/file path safely.
    $url = esc_url( $url );
    if ( ! $url ) {
        return '';
    }

    return sprintf(
        '<!-- wp:audio -->
<figure class="wp-block-audio"><audio controls src="%s"></audio></figure>
<!-- /wp:audio -->',
        $url
    );
}
