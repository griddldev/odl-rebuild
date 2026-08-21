<?php

use App\Blocks\BlockAttributes;

$cards = array_map(fn ($card) => [
    'backgroundColor' => BlockAttributes::colorSlug($card['backgroundColor'] ?? '', 'pink'),
    'title' => wp_kses_post($card['title'] ?? ''),
    'subtitle' => wp_kses_post($card['subtitle'] ?? ''),
    'body' => wp_kses_post($card['body'] ?? ''),
    'linkText' => wp_kses_post($card['linkText'] ?? ''),
    'link' => BlockAttributes::link($card['link'] ?? []),
], $attributes['cards'] ?? []);

echo view('blocks.card-grid', [
    'heading' => wp_kses_post($attributes['heading'] ?? ''),
    'subtitle' => wp_kses_post($attributes['subtitle'] ?? ''),
    'body' => wp_kses_post($attributes['body'] ?? ''),
    'cards' => $cards,
])->render();
