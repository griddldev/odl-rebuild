<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Add Tailwind classes to primary navigation menu items.
 */
add_filter('nav_menu_css_class', function (array $classes, $item, $args) {
    if (in_array($args->theme_location ?? null, ['primary_navigation', 'top_navigation', 'secondary_top_navigation'], true)) {
        $classes[] = 'list-none';
    }

    return $classes;
}, 10, 3);

add_filter('nav_menu_link_attributes', function (array $atts, $item, $args) {
    if (in_array($args->theme_location ?? null, ['primary_navigation', 'top_navigation', 'secondary_top_navigation'], true)) {
        $atts['class'] = trim(($atts['class'] ?? '') . ' primary-nav');
    }

    return $atts;
}, 10, 3);

add_filter('walker_nav_menu_start_el', function (string $item_output, $item) {
    if (in_array('menu-item-has-children', $item->classes, true)) {
        $isLastItem = in_array('last-item-header', $item->classes, true);
        $iconFile = $isLastItem ? 'accordion-open-white.svg' : 'accordion-open.svg';
        $iconUrl = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/' . $iconFile);
        $icon = '<img class="submenu-icon" src="' . esc_url($iconUrl) . '" alt="" width="25" height="25" aria-hidden="true">';
        $item_output = str_replace('</a>', $icon . '</a>', $item_output);
    }

    return $item_output;
}, 10, 2);
