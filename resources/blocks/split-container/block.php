<?php

use App\Blocks\BlockAttributes;

echo view('blocks.split-container', [
    'imageUrl' => esc_url_raw($attributes['imageUrl'] ?? ''),
    'imageAlt' => sanitize_text_field($attributes['imageAlt'] ?? ''),
    'heading' => wp_kses_post($attributes['heading'] ?? ''),
    'subtitle' => wp_kses_post($attributes['subtitle'] ?? ''),
    'mobileTitle' => wp_kses_post($attributes['mobileTitle'] ?? ''),
    'body' => wp_kses_post($attributes['body'] ?? ''),
    'link1Text' => wp_kses_post($attributes['link1Text'] ?? ''),
    'link1' => BlockAttributes::link($attributes['link1'] ?? []),
    'link2Text' => wp_kses_post($attributes['link2Text'] ?? ''),
    'link2' => BlockAttributes::link($attributes['link2'] ?? []),
])->render();
