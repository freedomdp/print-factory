<?php
/**
 * Підключення скриптів та стилів
 */

function print_factory_enqueue_assets()
{
    // Основний CSS
    wp_enqueue_style('print-factory-style', get_stylesheet_uri(), array(), '1.0.0');

    // Google Fonts
    wp_enqueue_style(
        'print-factory-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.5'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.5',
        true
    );

    // Локальні стилі
    $css_files = [
        'header' => '/assets/css/header.css',
        'bottom-nav' => '/assets/css/bottom-nav.css',
        'animations' => '/assets/css/animations.css',
        'backgrounds' => '/assets/css/backgrounds.css',
        'main' => '/assets/css/main.css',
    ];

    foreach ($css_files as $handle => $path) {
        wp_enqueue_style(
            'print-factory-' . $handle,
            get_template_directory_uri() . $path,
            array('print-factory-style'),
            '1.0.2'
        );
    }

    // Локальні скрипти
    wp_enqueue_script(
        'print-factory-animations',
        get_template_directory_uri() . '/assets/js/animations.js',
        array('jquery'),
        '1.0.0',
        true
    );

    // Передаємо дані калькулятора в JS (DRY)
    $content = PrintFactory_Content::get();
    wp_localize_script('print-factory-animations', 'PF_Config', array(
        'calculator' => $content['calculator'] ?? [],
        'pricing' => $content['pricing'] ?? []
    ));

    wp_enqueue_script(
        'print-factory-header',
        get_template_directory_uri() . '/assets/js/header.js',
        array('jquery'),
        '1.0.0',
        true
    );

    // Traveler Component
    wp_enqueue_style('print-factory-traveler', get_template_directory_uri() . '/assets/css/traveler.css', array(), '1.0.0');
    wp_enqueue_script('print-factory-traveler', get_template_directory_uri() . '/assets/js/traveler.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'print_factory_enqueue_assets');
