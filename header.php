<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header mobile-header sticky-top" id="site-header">
        <div class="container">
            <div class="header-inner">
                <!-- Logo -->
                <?php get_template_part('template-parts/header', 'logo'); ?>

                <!-- Desktop Navigation (hidden on mobile via CSS) -->
                <nav class="header-nav-desktop d-none d-lg-block">
                    <?php get_template_part('template-parts/header', 'nav'); ?>
                </nav>

                <!-- Actions -->
                <div class="header-actions">
                    <?php get_template_part('template-parts/header', 'calculator-button'); ?>
                    <?php get_template_part('template-parts/header', 'contacts-button'); ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Панель контактів (Drawer) -->
    <?php get_template_part('template-parts/header', 'contacts-drawer'); ?>