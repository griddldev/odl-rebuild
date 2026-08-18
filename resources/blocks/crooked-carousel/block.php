<?php

wp_enqueue_script('swiper');
wp_enqueue_style('swiper');

$heading = $attributes['heading'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$items = $attributes['items'] ?? [];

echo view('blocks.crooked-carousel', [
    'heading' => $heading,
    'subtitle' => $subtitle,
    'items' => $items,
])->render();
