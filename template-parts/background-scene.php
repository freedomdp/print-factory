<?php
/**
 * Background Scene Component
 * 
 * Args:
 * - show_grid (bool): Toggle grid visibility (default: true)
 * - show_blobs (bool): Toggle blobs visibility (default: true)
 * - show_decor (bool): Toggle decor elements visibility (default: true)
 * - blob_opacity (string): Override blob opacity (e.g. "0.5")
 */

$defaults = [
    'show_grid' => true,
    'show_blobs' => true,
    'show_decor' => true,
    'blob_opacity' => null,
];

// Merge defaults with passed args
$args = wp_parse_args($args ?? [], $defaults);
?>

<div class="bg-scene">
    <?php if ($args['show_grid']): ?>
        <div class="bg-grid"></div>
    <?php endif; ?>

    <?php if ($args['show_blobs']): ?>
        <div class="blob blob-1" <?php echo $args['blob_opacity'] ? 'style="opacity:' . esc_attr($args['blob_opacity']) . '"' : ''; ?>></div>
        <div class="blob blob-2" <?php echo $args['blob_opacity'] ? 'style="opacity:' . esc_attr($args['blob_opacity']) . '"' : ''; ?>></div>
        <div class="blob blob-3" <?php echo $args['blob_opacity'] ? 'style="opacity:' . esc_attr($args['blob_opacity']) . '"' : ''; ?>></div>
    <?php endif; ?>

    <?php if ($args['show_decor']): ?>
        <!-- Декоративні елементи (Flying Elements) -->
        <div class="decor-element decor-1">+</div>
        <div class="decor-element decor-2">.</div>
        <div class="decor-element decor-3">+</div>
        <div class="decor-element decor-4">.</div>
        <div class="decor-element decor-5"></div>
    <?php endif; ?>
</div>