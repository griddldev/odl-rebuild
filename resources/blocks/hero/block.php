<?php

$heading = wp_kses_post($attributes['heading'] ?? '');
$backgroundImageUrl = $attributes['backgroundImageUrl'] ?? '';
$backgroundImageId = $attributes['backgroundImageId'] ?? null;
$backgroundImageAlt = $attributes['backgroundImageAlt'] ?? '';
$videoUrl = $attributes['videoUrl'] ?? '';
$videoId = $attributes['videoId'] ?? null;
$link1Label = $attributes['link1Label'] ?? '';
$link1Url = $attributes['link1Url'] ?? '';
$link1Target = $attributes['link1Target'] ?? '_self';
$link2Label = $attributes['link2Label'] ?? '';
$link2Url = $attributes['link2Url'] ?? '';
$link2Target = $attributes['link2Target'] ?? '_self';
$link3Label = $attributes['link3Label'] ?? '';
$link3Url = $attributes['link3Url'] ?? '';
$link3Target = $attributes['link3Target'] ?? '_self';

echo view('blocks.hero', [
    'heading' => $heading,
    'backgroundImageUrl' => $backgroundImageUrl,
    'backgroundImageId' => $backgroundImageId,
    'backgroundImageAlt' => $backgroundImageAlt,
    'videoUrl' => $videoUrl,
    'videoId' => $videoId,
    'link1Label' => $link1Label,
    'link1Url' => $link1Url,
    'link1Target' => $link1Target,
    'link2Label' => $link2Label,
    'link2Url' => $link2Url,
    'link2Target' => $link2Target,
    'link3Label' => $link3Label,
    'link3Url' => $link3Url,
    'link3Target' => $link3Target,
])->render();
