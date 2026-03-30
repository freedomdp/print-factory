<?php
/**
 * Main Template
 */
get_header();

// Load content from JSON
$json_content = file_get_contents(get_template_directory() . '/content.json');
$content = json_decode($json_content, true);
?>

<!-- Dynamic Background Scene -->
<!-- Dynamic Background Scene -->
<?php get_template_part('template-parts/background-scene', null, [
    'show_grid' => true,
    'show_blobs' => true,
    'show_decor' => true
]); ?>

<main id="main-content">
    <!-- HERO SECTION -->
    <?php get_template_part('template-parts/hero', null, ['content' => $content]); ?>

    <!-- ABOUT SECTION -->
    <?php get_template_part('template-parts/about', null, ['content' => $content]); ?>

    <!-- SERVICES SECTION -->
    <?php get_template_part('template-parts/services', null, ['content' => $content]); ?>

    <!-- HOW IT WORKS -->
    <?php get_template_part('template-parts/how-it-works', null, ['content' => $content]); ?>

    <!-- MODALS (Calculator) -->
    <?php get_template_part('template-parts/calculator-modal', null, ['content' => $content]); ?>

    <!-- PORTFOLIO -->
    <?php get_template_part('template-parts/portfolio', null, ['content' => $content]); ?>

    <!-- MATERIALS & PRICES -->
    <?php get_template_part('template-parts/pricing', null, ['content' => $content]); ?>

    <!-- PAYMENT CONDITIONS -->
    <?php get_template_part('template-parts/payment', null, ['content' => $content]); ?>

    <!-- FAQ -->
    <?php get_template_part('template-parts/faq', null, ['content' => $content]); ?>
</main>

<!-- Sticky Bottom Navigation -->
<?php get_template_part('template-parts/bottom-nav'); ?>



<script>
    window.siteContent = <?php echo json_encode($content); ?>;
</script>

<?php get_footer(); ?>