<?php

use App\Blocks\BlockAttributes;

$cards = array_map(function ($card) {
    $link1 = BlockAttributes::link($card['link1'] ?? []);
    $link2 = BlockAttributes::link($card['link2'] ?? []);

    return [
        'backgroundColor' => BlockAttributes::colorSlug($card['backgroundColor'] ?? '', 'blue'),
        'title' => wp_kses_post($card['title'] ?? ''),
        'subtitle' => wp_kses_post($card['subtitle'] ?? ''),
        'body' => wp_kses_post($card['body'] ?? ''),
        'link1Text' => wp_kses_post($card['link1Text'] ?? ''),
        'link1' => $link1,
        'link2Text' => wp_kses_post($card['link2Text'] ?? ''),
        'link2' => $link2,
    ];
}, $attributes['cards'] ?? []);

echo view('blocks.colored-cards', [
    'heading' => wp_kses_post($attributes['heading'] ?? ''),
    'description' => wp_kses_post($attributes['description'] ?? ''),
    'cards' => $cards,
])->render();
