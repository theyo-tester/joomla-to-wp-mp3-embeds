<?php
/**
 * Plugin Name: Legacy MP3 Remote Embeds
 * Description: Renders legacy {mp3remote}...{/mp3remote} tags as WordPress audio blocks on single posts and blog views.
 * Version: 1.1.0
 */

add_filter( 'the_content', 'mysite_render_legacy_mp3_embeds', 8 );

function mysite_render_legacy_mp3_embeds( $content ) {
    // Allow single posts/pages, the blog homepage, and archives, but stay within the main query loop.
    if ( ! ( is_singular() || is_home() || is_archive() ) || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }

    return preg_replace_callback(
        '~\{mp3remote\}(.*?)\{/mp3remote\}~is',
        'mysite_render_one_legacy_mp3_embed',
        $content
    );
}

function mysite_render_one_legacy_mp3_embed( $matches ) {
    $url = trim( $matches[1] );

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