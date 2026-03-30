<?php
/**
 * Template part for displaying Hero section
 */
$content = $args['content'] ?? [];
$slides = $content['hero']['slides'] ?? [];
// DEBUG
// DEBUG
?>

<section id="hero" class="hero-section">
    <div class="hero-slider">
        <?php foreach ($slides as $index => $slide):
            // Map cta_action to section ID or modal trigger
            $cta_link = '#contact';
            $cta_class = '';
            if (!empty($slide['cta_action'])) {
                if ($slide['cta_action'] === 'scroll_to_portfolio') {
                    $cta_link = '#portfolio';
                } elseif ($slide['cta_action'] === 'scroll_to_form') {
                    $cta_link = '#contact';
                } elseif ($slide['cta_action'] === 'open_calculator') {
                    $cta_link = '#';
                    $cta_class = 'open-calc-trigger';
                }
            }
            ?>
            <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="hero-bg low-res"
                    style="background-image: url('<?php echo esc_url($slide['background_image_url'] ?? ''); ?>');"
                    data-bg-large="<?php echo esc_url($slide['background_image_large_url'] ?? ''); ?>">
                </div>
                <div class="container">
                    <div class="hero-content">
                        <?php if (!empty($slide['label'])): ?>
                            <div class="hero-badge">
                                <span><?php echo esc_html($slide['label']); ?></span>
                            </div>
                        <?php endif; ?>

                        <h1 class="animate-header"><?php echo esc_html($slide['title']); ?></h1>
                        <p class="hero-subtitle">
                            <?php echo esc_html($slide['subtitle']); ?>
                        </p>
                        <div class="hero-actions">
                            <a href="<?php echo esc_attr($cta_link); ?>"
                                class="btn-primary hero-btn-primary <?php echo esc_attr($cta_class); ?>">
                                <?php echo esc_html($slide['cta_text']); ?>
                            </a>
                            <?php if (!empty($slide['secondary_cta_text'])): ?>
                                <a href="#services" class="btn-secondary hero-btn-secondary">
                                    <?php echo esc_html($slide['secondary_cta_text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="hero-nav">
        <div class="container">
            <div class="hero-dots-wrapper">
                <?php foreach ($slides as $index => $slide): ?>
                    <span class="hero-dot <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-index="<?php echo $index; ?>"></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>