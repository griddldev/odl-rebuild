<?php

namespace App\Blocks;

/**
 * Sanitizers for the attribute shapes shared across blocks.
 *
 * block.php files are the sanitization boundary: Blade is view-only, so
 * every attribute is normalized here before it reaches a view.
 */
class BlockAttributes
{
    /**
     * Brand palette slugs. Mirrors resources/blocks/components/backend/brand-palette.js
     * and the tokens in resources/css/variables.css.
     */
    public const COLORS = [
        'blue' => '#4bc3ff',
        'yellow' => '#fddd4f',
        'pink' => '#f2c8f7',
        'teal' => '#42b289',
        'off-white' => '#ebefe6',
    ];

    /**
     * Normalize a Gutenberg LinkControl value into a render-ready shape.
     *
     * @param  mixed  $value  Raw attribute — expected {url, opensInNewTab}.
     * @return array{url: string, target: string, isEmpty: bool}
     */
    public static function link($value): array
    {
        $url = esc_url_raw($value['url'] ?? '');
        $opensInNewTab = (bool) ($value['opensInNewTab'] ?? false);

        return [
            'url' => $url,
            'target' => $opensInNewTab ? '_blank' : '_self',
            'isEmpty' => $url === '',
        ];
    }

    /**
     * Validate a stored palette slug, falling back when the attribute holds
     * a value that is no longer in the palette.
     */
    public static function colorSlug($value, string $fallback = 'blue'): string
    {
        $slug = is_string($value) ? $value : '';

        return isset(self::COLORS[$slug]) ? $slug : $fallback;
    }

    /** Resolve a palette slug to its literal hex, for front-end runtime use. */
    public static function colorHex($value, string $fallback = 'teal'): string
    {
        return self::COLORS[self::colorSlug($value, $fallback)];
    }
}
