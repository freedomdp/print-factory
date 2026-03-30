<?php
/**
 * Template part for displaying the About section
 */
$content = $args['content'] ?? [];
$about = $content['about'] ?? [];
?>
<section id="about" class="section-padding">
    <div class="container text-center">
        <h2 class="animate-header">
            <?php echo esc_html($about['title']); ?>
        </h2>

        <?php if (!empty($about['description'])): ?>
            <?php if (!empty($about['description'])): ?>
                <p class="section-subtitle">
                    <?php echo esc_html($about['description']); ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>

        <div class="stats-grid mt-5">
            <?php
            $delay = 0;
            foreach ($about['stats'] as $stat):
                $delay += 100; // Stagger effect
                ?>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                    <div class="stat-number">
                        <?php echo esc_html($stat['number']); ?>
                    </div>
                    <div class="stat-label">
                        <?php echo esc_html($stat['label']); ?>
                    </div>
                    <?php if (!empty($stat['sublabel'])): ?>
                        <div class="stat-sublabel">
                            <?php echo esc_html($stat['sublabel']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>