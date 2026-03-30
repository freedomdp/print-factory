<?php
/**
 * Header Navigation Template Part
 */
$menu = PrintFactory_Content::get_section('header.menu') ?? [];
?>

<ul class="nav-menu">
    <?php foreach ($menu as $item): ?>
        <li class="nav-item">
            <a href="<?php echo esc_url($item['url']); ?>" class="nav-link">
                <?php echo esc_html($item['label']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>