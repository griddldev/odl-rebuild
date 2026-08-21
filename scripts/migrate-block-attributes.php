<?php

/**
 * One-off migration for the block backend refactor.
 *
 * Converts the pre-refactor attribute shapes to the new ones:
 *   - <name>Url (+ <name>Target) string pair  ->  <name> LinkControl object
 *   - hero link<N>Label                        ->  link<N>Text
 *   - interactive-gallery activeColor hex      ->  brand palette slug
 *
 * Usage (from the theme root):
 *   wp eval-file scripts/migrate-block-attributes.php          # dry run
 *   wp eval-file scripts/migrate-block-attributes.php apply    # write
 *
 * @see resources/blocks/components/backend/brand-palette.js
 */

$apply = in_array('apply', $args ?? [], true);

$hexToSlug = [
    '#42b289' => 'teal',
    '#f2c8f7' => 'pink',
    '#fddd4f' => 'yellow',
    '#4bc3ff' => 'blue',
    '#ebefe6' => 'off-white',
];

/** Build a LinkControl object from the old url/target pair. */
$toLink = function (array $attrs, string $urlKey, ?string $targetKey = null): array {
    $url = $attrs[$urlKey] ?? '';
    $target = $targetKey !== null ? ($attrs[$targetKey] ?? '_self') : '_self';

    return [
        'url' => is_string($url) ? $url : '',
        'opensInNewTab' => $target === '_blank',
    ];
};

$stats = [];

$migrateAttrs = function (string $name, array $attrs) use (&$stats, $toLink, $hexToSlug): array {
    $touch = function (string $what) use (&$stats, $name) {
        $stats["{$name}: {$what}"] = ($stats["{$name}: {$what}"] ?? 0) + 1;
    };

    if ($name === 'sage/hero') {
        foreach ([1, 2, 3] as $n) {
            if (array_key_exists("link{$n}Label", $attrs)) {
                $attrs["link{$n}Text"] = $attrs["link{$n}Label"];
                unset($attrs["link{$n}Label"]);
                $touch("link{$n}Label -> link{$n}Text");
            }
            if (array_key_exists("link{$n}Url", $attrs) || array_key_exists("link{$n}Target", $attrs)) {
                $attrs["link{$n}"] = $toLink($attrs, "link{$n}Url", "link{$n}Target");
                unset($attrs["link{$n}Url"], $attrs["link{$n}Target"]);
                $touch("link{$n} -> object");
            }
        }
    }

    if ($name === 'sage/split-container') {
        foreach ([1, 2] as $n) {
            if (array_key_exists("link{$n}Url", $attrs)) {
                $attrs["link{$n}"] = $toLink($attrs, "link{$n}Url");
                unset($attrs["link{$n}Url"]);
                $touch("link{$n} -> object");
            }
        }
    }

    if ($name === 'sage/blog-section') {
        if (array_key_exists('allBlogsUrl', $attrs) || array_key_exists('allBlogsTarget', $attrs)) {
            $attrs['allBlogsLink'] = $toLink($attrs, 'allBlogsUrl', 'allBlogsTarget');
            unset($attrs['allBlogsUrl'], $attrs['allBlogsTarget']);
            $touch('allBlogsLink -> object');
        }
    }

    if ($name === 'sage/colored-cards' && ! empty($attrs['cards'])) {
        $attrs['cards'] = array_map(function ($card) use ($toLink, $touch) {
            foreach ([1, 2] as $n) {
                if (array_key_exists("link{$n}Url", $card)) {
                    $card["link{$n}"] = $toLink($card, "link{$n}Url");
                    unset($card["link{$n}Url"]);
                    $touch("card link{$n} -> object");
                }
            }

            return $card;
        }, $attrs['cards']);
    }

    if ($name === 'sage/card-grid' && ! empty($attrs['cards'])) {
        $attrs['cards'] = array_map(function ($card) use ($toLink, $touch) {
            if (array_key_exists('linkUrl', $card)) {
                $card['link'] = $toLink($card, 'linkUrl');
                unset($card['linkUrl']);
                $touch('card link -> object');
            }

            return $card;
        }, $attrs['cards']);
    }

    if ($name === 'sage/split-accordion' && ! empty($attrs['items'])) {
        $attrs['items'] = array_map(function ($item) use ($toLink, $touch) {
            if (array_key_exists('linkUrl', $item)) {
                $item['link'] = $toLink($item, 'linkUrl');
                unset($item['linkUrl']);
                $touch('item link -> object');
            }

            return $item;
        }, $attrs['items']);
    }

    if ($name === 'sage/interactive-gallery' && ! empty($attrs['items'])) {
        $attrs['items'] = array_map(function ($item) use ($hexToSlug, $touch) {
            $color = strtolower((string) ($item['activeColor'] ?? ''));
            if ($color !== '' && str_starts_with($color, '#')) {
                $item['activeColor'] = $hexToSlug[$color] ?? 'teal';
                $touch('activeColor hex -> slug');
            }

            return $item;
        }, $attrs['items']);
    }

    return $attrs;
};

$walk = function (array $blocks) use (&$walk, $migrateAttrs): array {
    foreach ($blocks as &$block) {
        if (! empty($block['blockName']) && str_starts_with($block['blockName'], 'sage/')) {
            $block['attrs'] = $migrateAttrs($block['blockName'], $block['attrs'] ?? []);
        }
        if (! empty($block['innerBlocks'])) {
            $block['innerBlocks'] = $walk($block['innerBlocks']);
        }
    }

    return $blocks;
};

$posts = get_posts([
    'post_type' => 'any',
    'post_status' => 'any',
    'posts_per_page' => -1,
    's' => 'wp:sage/',
    'fields' => 'ids',
]);

WP_CLI::log($apply ? 'Mode: APPLY' : 'Mode: DRY RUN (pass "apply" to write)');
WP_CLI::log(sprintf('Scanning %d post(s)...', count($posts)));

$changed = 0;

foreach ($posts as $id) {
    $post = get_post($id);
    $before = $post->post_content;

    if (! str_contains($before, 'wp:sage/')) {
        continue;
    }

    $after = serialize_blocks($walk(parse_blocks($before)));

    if ($after === $before) {
        continue;
    }

    $changed++;
    WP_CLI::log(sprintf(
        '  #%d %s (%s) — %d -> %d bytes',
        $id,
        $post->post_title ?: '(no title)',
        $post->post_type,
        strlen($before),
        strlen($after)
    ));

    if ($apply) {
        // wp_update_post() runs the content through KSES for some roles and
        // would strip block delimiters; write the column directly instead.
        global $wpdb;
        $wpdb->update($wpdb->posts, ['post_content' => $after], ['ID' => $id]);
        clean_post_cache($id);
    }
}

WP_CLI::log('');
foreach ($stats as $what => $n) {
    WP_CLI::log(sprintf('  %-46s %d', $what, $n));
}

WP_CLI::success(sprintf(
    '%d post(s) %s.',
    $changed,
    $apply ? 'migrated' : 'would be migrated'
));
