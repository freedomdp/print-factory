<?php
/**
 * Template part for displaying Payment section
 */
$content = $args['content'] ?? [];
?>
<section id="payment" class="section-padding">
    <!-- Background Decor -->
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/payment_bg_icon.png" class="payment-bg-icon"
        alt="" style="mix-blend-mode: screen;">

    <div class="container" style="position: relative; z-index: 2;">
        <div class="payment-grid">
            <!-- Left Column: Header & CTA -->
            <div class="payment-left">
                <h2 class="animate-header">
                    <?php echo esc_html($content['payment']['title']); ?>
                </h2>
                <p class="section-subtitle" style="margin: 0; max-width: 480px; text-align: left;">
                    <?php echo esc_html($content['payment']['btb_title']); ?>
                </p>

                <div class="payment-features-list">
                    <div class="pay-feature-row">
                        <i class="fas fa-bolt"></i>
                        <span>Миттєвий онлайн розрахунок</span>
                    </div>
                    <div class="pay-feature-row">
                        <i class="fas fa-clock"></i>
                        <span>Точний кошторис за 2 години</span>
                    </div>
                    <div class="pay-feature-row">
                        <i class="fas fa-file-contract"></i>
                        <span>Офіційний договір</span>
                    </div>
                </div>

                <div>
                    <button class="hero-btn-primary"
                        onclick="document.getElementById('calculator-overlay').classList.add('active');">
                        Розпочати роботу <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </div>
            </div>

            <!-- Right Column: Interactive Card -->
            <div class="payment-right">
                <div class="payment-card-container">
                    <div class="payment-card">
                        <div class="payment-card-header">
                            <h4>Умови оплати</h4>
                            <div class="payment-tabs compact">
                                <div class="pay-tab active" data-target="b2c">
                                    <?php echo esc_html($content['payment']['b2c']['label']); ?>
                                </div>
                                <div class="pay-tab" data-target="b2b">
                                    <?php echo esc_html($content['payment']['b2b']['label']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="payment-card-body">
                            <!-- B2C -->
                            <div id="pay-b2c" class="pay-content">
                                <ul class="check-list">
                                    <?php foreach ($content['payment']['b2c']['methods'] as $method): ?>
                                        <li>
                                            <div class="check-icon"><i class="fas fa-check"></i></div>
                                            <span><?php echo esc_html($method); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php foreach ($content['payment']['b2c']['docs'] as $doc): ?>
                                        <li>
                                            <div class="check-icon"><i class="fas fa-file-alt"></i></div>
                                            <span><?php echo esc_html($doc); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- B2B -->
                            <div id="pay-b2b" class="pay-content" style="display: none;">
                                <ul class="check-list">
                                    <?php foreach ($content['payment']['b2b']['methods'] as $method): ?>
                                        <li>
                                            <div class="check-icon"><i class="fas fa-check"></i></div>
                                            <span><?php echo esc_html($method); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php foreach ($content['payment']['b2b']['docs'] as $doc): ?>
                                        <li>
                                            <div class="check-icon"><i class="fas fa-file-invoice"></i></div>
                                            <span><?php echo esc_html($doc); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Info Blocks -->
                <div class="payment-bottom-info">
                    <div class="info-block">
                        <i class="fas fa-building"></i>
                        <div class="info-text">
                            <strong>Юридичні особи</strong>
                            <span>Оплата з ПДВ</span>
                        </div>
                    </div>
                    <div class="info-block">
                        <i class="fas fa-credit-card"></i>
                        <div class="info-text">
                            <strong>Фізичні особи</strong>
                            <span>Картка / QR-код</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>