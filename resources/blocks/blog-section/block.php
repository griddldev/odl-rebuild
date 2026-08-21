<?php

$title                = $attributes['title'] ?? 'Blogs';
$featuredCategorySlug = $attributes['featuredCategorySlug'] ?? 'featured';
$allBlogsLink         = \App\Blocks\BlockAttributes::link($attributes['allBlogsLink'] ?? []);

// Featured post: latest post in the "featured" category
$featuredPost = null;
$featuredQuery = new WP_Query([
    'category_name'  => $featuredCategorySlug,
    'posts_per_page' => 1,
    'post_status'    => 'publish',
]);

if ($featuredQuery->have_posts()) {
    $featuredQuery->the_post();
    $featuredId = get_the_ID();

    $featuredPost = [
        'title'      => get_the_title(),
        'excerpt'    => get_the_excerpt(),
        'permalink'  => get_permalink(),
        'image'      => get_the_post_thumbnail_url($featuredId, 'large'),
        'imageAlt'   => get_post_meta(get_post_thumbnail_id($featuredId), '_wp_attachment_image_alt', true),
        'categories' => wp_get_post_categories($featuredId, ['fields' => 'names']),
    ];

    wp_reset_postdata();
}

// Latest posts: exclude the featured post
$latestPosts = [];
$latestQuery = new WP_Query([
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'post__not_in'   => $featuredPost ? [$featuredId] : [],
]);

if ($latestQuery->have_posts()) {
    while ($latestQuery->have_posts()) {
        $latestQuery->the_post();
        $postId = get_the_ID();

        $latestPosts[] = [
            'title'      => get_the_title(),
            'excerpt'    => get_the_excerpt(),
            'permalink'  => get_permalink(),
            'image'      => get_the_post_thumbnail_url($postId, 'medium_large'),
            'imageAlt'   => get_post_meta(get_post_thumbnail_id($postId), '_wp_attachment_image_alt', true),
            'categories' => wp_get_post_categories($postId, ['fields' => 'names']),
            'date'       => get_the_date('M d, Y'),
        ];
    }

    wp_reset_postdata();
}

$cardColors = ['yellow', 'pink', 'teal'];

echo view('blocks.blog-section', [
    'title'        => $title,
    'featuredPost' => $featuredPost,
    'latestPosts'  => $latestPosts,
    'allBlogsLink' => $allBlogsLink,
    'cardColors'   => $cardColors,
])->render();
