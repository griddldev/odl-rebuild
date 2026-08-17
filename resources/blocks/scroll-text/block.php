<?php

$content = wp_kses_post($attributes['content'] ?? '');

echo view('blocks.scroll-text', [
    'content' => $content,
])->render();
