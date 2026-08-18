<?php

$heading = $attributes['heading'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$imageUrl = $attributes['imageUrl'] ?? '';
$imageAlt = $attributes['imageAlt'] ?? '';
$items = $attributes['items'] ?? [];

echo view('blocks.split-accordion', [
    'heading' => $heading,
    'subtitle' => $subtitle,
    'imageUrl' => $imageUrl,
    'imageAlt' => $imageAlt,
    'items' => $items,
])->render();
