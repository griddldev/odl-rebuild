<?php

$imageUrl = $attributes['imageUrl'] ?? '';
$imageAlt = $attributes['imageAlt'] ?? '';
$heading = $attributes['heading'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$body = $attributes['body'] ?? '';
$link1Text = $attributes['link1Text'] ?? '';
$link1Url = $attributes['link1Url'] ?? '';
$link2Text = $attributes['link2Text'] ?? '';
$link2Url = $attributes['link2Url'] ?? '';

echo view('blocks.split-container', [
    'imageUrl' => $imageUrl,
    'imageAlt' => $imageAlt,
    'heading' => $heading,
    'subtitle' => $subtitle,
    'body' => $body,
    'link1Text' => $link1Text,
    'link1Url' => $link1Url,
    'link2Text' => $link2Text,
    'link2Url' => $link2Url,
])->render();
