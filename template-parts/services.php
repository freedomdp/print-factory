<?php
/**
 * Services Section (Split Tiles Design)
 */
$content = $args['content'] ?? [];
$services = $content['services'] ?? [];
?>

<section id="services" class="section-padding">
    <div class="container">
        <?php if (!empty($services['title'])): ?>
            <h2 class="animate-header text-center mb-5">
                <?php echo esc_html($services['title']); ?>
            </h2>
        <?php endif; ?>

        <div class="services-grid">
            <?php foreach ($services['items'] as $index => $item): ?>
                <div class="service-tile" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <!-- Problem Side (Left) -->
                    <div class="service-problem">
                        <h3 class="service-title">
                            <?php echo wp_kses_post($item['title']); ?>
                        </h3>
                        <div class="service-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Solution Side (Right) -->
                    <div class="service-solution">
                        <div class="solution-content">
                            <i class="<?php echo esc_attr($item['icon']); ?> service-icon"></i>
                            <h3 class="solution-title">
                                <?php echo wp_kses_post($item['title']); ?>
                            </h3>
                            <p class="solution-desc">
                                <?php echo esc_html($item['description']); ?>
                            </p>

                            <a href="#" class="btn btn-outline-light btn-sm mt-3 service-cta open-calc-trigger">
                                <?php echo esc_html('Замовити розрахунок'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>