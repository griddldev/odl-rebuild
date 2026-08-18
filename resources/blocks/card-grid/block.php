<?php

$heading = $attributes['heading'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$body = $attributes['body'] ?? '';
$cards = $attributes['cards'] ?? [];

echo view('blocks.card-grid', [
    'heading' => $heading,
    'subtitle' => $subtitle,
    'body' => $body,
    'cards' => $cards,
])->render();
