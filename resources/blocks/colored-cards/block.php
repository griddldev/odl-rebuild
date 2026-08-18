<?php

$heading = $attributes['heading'] ?? '';
$description = $attributes['description'] ?? '';
$cards = $attributes['cards'] ?? [];

echo view('blocks.colored-cards', [
    'heading' => $heading,
    'description' => $description,
    'cards' => $cards,
])->render();
