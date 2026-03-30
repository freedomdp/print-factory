<?php
/**
 * Оптимізації, безпека та чистка head
 */

// Відключити REST API для неавторизованих користувачів
add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result)) {
        return $result;
    }
    if (!is_user_logged_in()) {
        return new WP_Error(
            'rest_disabled',
            'REST API disabled for unauthorized users',
            ['status' => 401]
        );
    }
    return $result;
});

// Відключити XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Відключити емоджі
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// Відключити jQuery Migrate
function print_factory_remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
}
add_action('wp_default_scripts', 'print_factory_remove_jquery_migrate');

// Hide Admin Bar for all users on frontend
add_filter('show_admin_bar', '__return_false');

// Видалити версії з завантажуваних файлів (опціонально, зараз вимкнено для дебагу)
function print_factory_remove_version_strings($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
// add_filter('style_loader_src', 'print_factory_remove_version_strings', 9999);
// add_filter('script_loader_src', 'print_factory_remove_version_strings', 9999);
