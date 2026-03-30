<?php
/**
 * Template part for displaying "How It Works" section
 */
$content = $args['content'] ?? [];
?>
<section id="services">
    <div class="container text-center">
        <h2 class="animate-header" data-aos="fade-up">
            <?php echo esc_html($content['how_it_works']['title']); ?>
        </h2>

        <div class="steps-timeline-wrapper mt-5">
            <?php
            $steps = $content['how_it_works']['steps'];
            $total_steps = count($steps);
            foreach ($steps as $index => $step):
                $is_last = ($index === $total_steps - 1);
                // Stagger animations with 100ms delay per step
                $delay = $index * 100;
                ?>
                <div class="timeline-step <?php echo $is_last ? 'last-step' : ''; ?>" data-aos="fade-up"
                    data-aos-delay="<?php echo $delay; ?>">

                    <div class="timeline-icon-wrap">
                        <div class="timeline-icon">
                            <i class="<?php echo esc_attr($step['icon']); ?>"></i>
                        </div>
                        <?php if (!$is_last): ?>
                            <div class="timeline-connector">
                                <div class="connector-line"></div>
                                <div class="connector-arrow"></div>
                            </div>
                        <?php endif; ?>

                        <div class="step-badge"><?php echo esc_html($step['id']); ?></div>
                    </div>

                    <div class="timeline-content">
                        <h3><?php echo esc_html($step['title']); ?></h3>
                        <p><?php echo esc_html($step['text']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>