<?php
/**
 * Template part for displaying Pricing section
 */
$content = $args['content'] ?? [];
?>
<section id="price" class="section-padding">
    <div class="container">
        <div class="text-left mb-5">
            <h2 class="animate-header">
                <?php echo esc_html($content['pricing']['title']); ?>
            </h2>
            <p class="section-subtitle" style="margin-left: 0; text-align: left;">
                <?php echo esc_html($content['pricing']['subtitle']); ?>
            </p>
        </div>

        <div class="pricing-container mt-5">
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Матеріал</th>
                        <th>1 шт.</th>
                        <th>ЗНИЖКА (ОПТ)</th>
                        <th class="usage-col">Застосування</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $min_discount = $content['calculator']['discounts']['quantity_progressive']['min_discount'] ?? 5;
                    $max_discount = $content['calculator']['discounts']['quantity_progressive']['max_discount'] ?? 30;
                    ?>
                    <?php foreach ($content['pricing']['materials'] as $mat): ?>
                        <tr class="material-row" data-material="<?php echo esc_attr($mat['name']); ?>">
                            <td class="material-name-cell">
                                <span class="mat-name"><?php echo esc_html($mat['name']); ?></span>
                                <div class="info-icon-wrapper">
                                    <span class="info-icon" onclick="this.classList.toggle('active')">i</span>
                                    <div class="info-tooltip"><?php echo esc_html($mat['usage']); ?></div>
                                </div>
                            </td>
                            <td class="price-tag">
                                <?php echo esc_html($mat['price_single']); ?>
                            </td>
                            <td class="price-tag">
                                <div class="discount-range-wrapper">
                                    <span class="discount-badge">
                                        −<?php echo $min_discount; ?>% ... −<?php echo $max_discount; ?>%
                                    </span>
                                </div>
                            </td>
                            <td class="usage-col" style="font-size: 14px; opacity: 0.8;">
                                <?php echo esc_html($mat['usage']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="discount-global-note mt-3">
                *розмір знижки залежить від загальної ваги замовлення та тиражу виробів
            </div>
            <div class="pricing-cta mt-5">
                <button class="hero-btn-primary"
                    onclick="document.getElementById('calculator-overlay').classList.add('active');">
                    Розрахувати проєкт <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('click', function (e) {
        // Close tooltips when clicking outside
        if (!e.target.closest('.info-icon-wrapper')) {
            document.querySelectorAll('.info-icon.active').forEach(function (icon) {
                icon.classList.remove('active');
            });
        }
    });
</script>