<?php
/**
 * Sticky Bottom Navigation "Brick"
 */
$header_data = PrintFactory_Content::get_section('header');
$menu_items = array_slice($header_data['menu'] ?? [], 0, 4); // Беремо перші 4 пункти
?>

<nav class="bottom-nav">
    <div class="bottom-nav-inner">
        <?php
        $fa_icons = [
            'fa-solid fa-circle-info',
            'fa-solid fa-shapes',
            'fa-solid fa-images',
            'fa-solid fa-tags'
        ];
        foreach ($menu_items as $index => $item):
            $icon_class = $fa_icons[$index] ?? 'fa-solid fa-link';
            ?>
            <a href="<?php echo esc_url($item['url']); ?>" class="nav-item">
                <span class="nav-icon">
                    <i class="<?php echo esc_attr($icon_class); ?>"></i>
                </span>
                <span class="nav-label">
                    <?php
                    $label = $item['label'];
                    if ($label === 'Матеріали та ціни')
                        $label = 'Ціни';
                    echo esc_html($label);
                    ?>
                </span>
            </a>
        <?php endforeach; ?>
    </div>
</nav>