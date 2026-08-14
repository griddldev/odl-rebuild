<?php

namespace App\Blocks;

class BlockCategories
{
    public const SLUG = 'custom-blocks';
    public const TITLE = 'Custom Blocks';

    public static function register(): void
    {
        add_filter('block_categories_all', function (array $categories): array {
            $filtered = array_values(array_filter(
                $categories,
                fn ($cat) => ($cat['slug'] ?? '') !== self::SLUG
            ));

            array_unshift($filtered, [
                'slug'  => self::SLUG,
                'title' => self::TITLE,
                'icon'  => null,
            ]);

            return $filtered;
        }, 5);
    }
}
