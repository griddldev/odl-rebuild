<?php

use App\Blocks\BlockAttributes;

$items = array_map(fn ($item) => [
    'title' => wp_kses_post($item['title'] ?? ''),
    'content' => wp_kses_post($item['content'] ?? ''),
    'linkText' => wp_kses_post($item['linkText'] ?? ''),
    'link' => BlockAttributes::link($item['link'] ?? []),
], $attributes['items'] ?? []);

echo view('blocks.split-accordion', [
    'heading' => wp_kses_post($attributes['heading'] ?? ''),
    'subtitleFaded' => wp_kses_post($attributes['subtitleFaded'] ?? ''),
    'subtitleMain' => wp_kses_post($attributes['subtitleMain'] ?? ''),
    'imageUrl' => esc_url_raw($attributes['imageUrl'] ?? ''),
    'imageAlt' => sanitize_text_field($attributes['imageAlt'] ?? ''),
    'items' => $items,
])->render();
