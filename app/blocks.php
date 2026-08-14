<?php

/**
 * Block bootstrap.
 *
 * Loaded by functions.php via collect(['setup', 'filters', 'blocks']).
 */

namespace App;

use App\Blocks\BlockCategories;
use App\Blocks\BlockManager;

BlockCategories::register();

add_action('init', function () {
    (new BlockManager())->register();
});
