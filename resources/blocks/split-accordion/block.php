<?php

$heading = $attributes['heading'] ?? '';
$subtitleFaded = $attributes['subtitleFaded'] ?? '';
$subtitleMain = $attributes['subtitleMain'] ?? '';
$imageUrl = $attributes['imageUrl'] ?? '';
$imageAlt = $attributes['imageAlt'] ?? '';
$items = $attributes['items'] ?? [];

echo view('blocks.split-accordion', [
    'heading' => $heading,
    'subtitleFaded' => $subtitleFaded,
    'subtitleMain' => $subtitleMain,
    'imageUrl' => $imageUrl,
    'imageAlt' => $imageAlt,
    'items' => $items,
])->render();
