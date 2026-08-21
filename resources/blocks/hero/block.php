<?php

use App\Blocks\BlockAttributes;

$links = [];

foreach ([1, 2, 3] as $n) {
    $text = wp_kses_post($attributes["link{$n}Text"] ?? '');
    $link = BlockAttributes::link($attributes["link{$n}"] ?? []);

    if ($text === '') {
        continue;
    }

    $links[] = [
        'text' => $text,
        'url' => $link['url'],
        'target' => $link['target'],
    ];
}

echo view('blocks.hero', [
    'heading' => wp_kses_post($attributes['heading'] ?? ''),
    'backgroundImageUrl' => esc_url_raw($attributes['backgroundImageUrl'] ?? ''),
    'backgroundImageId' => absint($attributes['backgroundImageId'] ?? 0),
    'backgroundImageAlt' => sanitize_text_field($attributes['backgroundImageAlt'] ?? ''),
    'videoUrl' => esc_url_raw($attributes['videoUrl'] ?? ''),
    'videoId' => absint($attributes['videoId'] ?? 0),
    'links' => $links,
])->render();
