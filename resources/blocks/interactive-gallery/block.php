<?php

$heading = $attributes['heading'] ?? '';
$items = $attributes['items'] ?? [];

echo view('blocks.interactive-gallery', [
    'heading' => $heading,
    'items' => $items,
])->render();
