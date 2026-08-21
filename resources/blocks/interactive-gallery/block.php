<?php

use App\Blocks\BlockAttributes;

// The front end swaps the section background at runtime (block.js reads
// data-active-color), so the slug is resolved to its literal hex here.
$items = array_map(fn ($item) => [
    'imageUrl' => esc_url_raw($item['imageUrl'] ?? ''),
    'imageId' => absint($item['imageId'] ?? 0),
    'imageAlt' => sanitize_text_field($item['imageAlt'] ?? ''),
    'title' => wp_kses_post($item['title'] ?? ''),
    'description' => wp_kses_post($item['description'] ?? ''),
    'activeColor' => BlockAttributes::colorHex($item['activeColor'] ?? '', 'teal'),
], $attributes['items'] ?? []);

echo view('blocks.interactive-gallery', [
    'heading' => wp_kses_post($attributes['heading'] ?? ''),
    'items' => $items,
    'firstColor' => $items[0]['activeColor'] ?? BlockAttributes::COLORS['teal'],
])->render();
