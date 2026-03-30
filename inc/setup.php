<?php
/**
 * Основні налаштування теми
 */

if (!function_exists('print_factory_setup')):
    function print_factory_setup()
    {
        // Підтримка title tag
        add_theme_support('title-tag');

        // Підтримка featured images
        add_theme_support('post-thumbnails');

        // Підтримка HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
    }
endif;
add_action('after_setup_theme', 'print_factory_setup');
