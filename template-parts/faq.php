<?php
/**
 * Template part for displaying FAQ section
 */
$content = $args['content'] ?? [];
?>
<section id="faq" class="section-padding">
    <div class="container text-center">
        <h2 class="animate-header">
            <?php echo esc_html($content['faq']['title']); ?>
        </h2>
        <div class="faq-container mt-5">
            <?php foreach ($content['faq']['items'] as $index => $item): ?>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>
                            <?php echo esc_html($item['question']); ?>
                        </span>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>
                            <?php echo esc_html($item['answer']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>