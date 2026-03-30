<?php
/**
 * Template part for Calculator Modal (Quiz)
 */
$content = $args['content'] ?? [];
$materials = $content['pricing']['materials'] ?? [];
?>

<div class="calculator-overlay" id="calculator-overlay" aria-hidden="true">
    <div class="calculator-modal">
        <button class="calc-close" id="calc-close" aria-label="Закрити">&times;</button>

        <div class="calc-steps-indicator">
            <div class="step-dot active" data-step="1">1</div>
            <div class="step-line"></div>
            <div class="step-dot" data-step="2">2</div>
        </div>

        <form id="calc-form" class="calc-form">
            <!-- Step 1: Calculation -->
            <div class="calc-step active" id="calc-step-1">
                <h2 class="calc-title">Розрахувати вартість проєкту</h2>

                <div class="form-group">
                    <label>Матеріал</label>
                    <select id="calc-material" name="material" class="calc-select" required>
                        <option value="" disabled selected>Оберіть матеріал...</option>
                        <?php
                        $densities = $content['calculator']['material_densities'] ?? [];
                        foreach ($materials as $mat):
                            $mat_name = $mat['name'];
                            $density = $densities[$mat_name] ?? ($densities[strtok($mat_name, '/')] ?? '1.24');
                            ?>
                            <option value="<?php echo esc_attr($mat_name); ?>"
                                data-price="<?php echo esc_attr(preg_replace('/[^0-9.]/', '', $mat['price_single'])); ?>"
                                data-bulk-price="<?php echo esc_attr(preg_replace('/[^0-9.]/', '', $mat['price_bulk'])); ?>"
                                data-density="<?php echo esc_attr($density); ?>">
                                <?php echo esc_html($mat['name']); ?> (<?php echo esc_html($mat['usage']); ?>) —
                                <?php echo esc_html($mat['price_single']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label>Ширина (мм)</label>
                        <input type="number" id="calc-width" name="width" placeholder="0" min="1" max="2560" required>
                    </div>
                    <div class="form-group col">
                        <label>Висота (мм)</label>
                        <input type="number" id="calc-height" name="height" placeholder="0" min="1" max="2560" required>
                    </div>
                    <div class="form-group col">
                        <label>Глибина (мм)</label>
                        <input type="number" id="calc-depth" name="depth" placeholder="0" min="1" max="2560" required>
                    </div>
                </div>
                <div class="calc-warning">
                    <p><?php echo esc_html($content['calculator']['warning_text'] ?? '⚠️ Для попереднього розрахунку вважаємо, що виріб простої прямокутної форми.'); ?>
                    </p>
                </div>
                <div class="calc-warning size-warning"
                    style="display: none; background: rgba(239, 68, 68, 0.1); border-left-color: var(--color-error);">
                    <p>⚠️ Модель виходить за розміри принтеру (>256 мм), тому буде збиратись (+10% до вартості).</p>
                </div>

                <div class="form-group full-width">
                    <label>Заповнення: <span id="infill-val">20</span>%</label>
                    <input type="range" id="calc-infill" name="infill" min="5" max="100" value="20" step="5">
                    <div class="calc-warning">
                        <p>💡 Відсоток заповнення впливає на міцність та вагу деталі.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label>Кількість (шт)</label>
                    <input type="number" id="calc-qty" name="qty" value="1" min="1" required>
                </div>

                <div class="calc-summary">
                    <div class="summary-line">
                        <span>Орієнтовна вартість:</span>
                        <span id="calc-total-price">0.00 грн</span>
                    </div>
                    <div id="min-order-warning"
                        style="display: none; color: var(--accent-orange); font-size: 13px; text-align: center; margin-top: 5px;">
                        ⚠️ Застосовано мінімальну суму замовлення
                        (<?php echo esc_html($content['calculator']['min_order_amount'] ?? '150'); ?> грн)
                    </div>
                    <div id="calc-weight-display"
                        style="font-size: var(--font-size-sm); color: var(--text-secondary); text-align: center; margin-top: var(--space-xs); display: none;">
                        Вага: <span id="calc-weight-val">0</span> г
                    </div>
                    <p class="calc-warning mt-2" style="background:none; border:none; padding:0; text-align:center;">
                        Ціна є попередньою та може бути скоригована після аналізу моделі.
                    </p>
                    <div class="discount-badge" id="discount-badge" style="display: none;">
                        Знижка -<span id="discount-val">0</span>% засторована
                    </div>
                </div>

                <div class="calc-btns">
                    <button type="button" class="btn-primary w-100" id="to-step-2">
                        Отримати точний розрахунок &rarr;
                    </button>
                </div>
            </div>

            <!-- Step 2: Contact Info -->
            <div class="calc-step" id="calc-step-2">
                <h2 class="calc-title">Контактна інформація</h2>

                <div class="form-group">
                    <label>Макет або фото (STL, PNG, JPG)</label>
                    <div class="file-upload">
                        <input type="file" id="calc-file" name="file" accept=".stl,.png,.jpg,.jpeg">
                        <div class="file-label">Виберіть файл або перетягніть сюди</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ваше ім'я</label>
                    <input type="text" id="calc-name" name="name" placeholder="Як до вас звертатися?" required>
                </div>

                <div class="form-group">
                    <label>Номер телефону</label>
                    <input type="tel" id="calc-phone" name="phone" placeholder="+38 (0...) ..." required>
                </div>

                <div class="form-group">
                    <label>Куди надіслати відповідь?</label>
                    <div class="messenger-selector">
                        <label class="messenger-option">
                            <input type="radio" name="messenger" value="call" checked>
                            <div class="messenger-icon" title="Звонок">
                                <img src="<?php echo esc_url($content['header']['contacts']['phone_icon']); ?>"
                                    alt="Дзвінок">
                            </div>
                        </label>
                        <label class="messenger-option">
                            <input type="radio" name="messenger" value="telegram">
                            <div class="messenger-icon" title="Telegram">
                                <img src="<?php echo esc_url($content['header']['contacts']['telegram_icon']); ?>"
                                    alt="Telegram">
                            </div>
                        </label>
                        <label class="messenger-option">
                            <input type="radio" name="messenger" value="viber">
                            <div class="messenger-icon" title="Viber">
                                <img src="<?php echo esc_url($content['header']['contacts']['viber_icon']); ?>"
                                    alt="Viber">
                            </div>
                        </label>
                        <label class="messenger-option">
                            <input type="radio" name="messenger" value="whatsapp">
                            <div class="messenger-icon" title="WhatsApp">
                                <img src="<?php echo esc_url($content['header']['contacts']['whatsapp_icon']); ?>"
                                    alt="WhatsApp">
                            </div>
                        </label>
                        <label class="messenger-option">
                            <input type="radio" name="messenger" value="email">
                            <div class="messenger-icon" title="Email">
                                <img src="<?php echo esc_url($content['header']['contacts']['email_icon']); ?>"
                                    alt="Email">
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-group" id="email-field-group" style="display: none;">
                    <label>Ваш Email</label>
                    <input type="email" id="calc-email" name="email" placeholder="example@mail.com">
                </div>

                <div class="form-group">
                    <label>Коментар до замовлення</label>
                    <textarea id="calc-comment" name="comment" rows="3" placeholder="Додаткові побажання..."></textarea>
                </div>

                <div class="calc-btns">
                    <button type="button" class="btn-secondary" id="back-to-step-1">Назад</button>
                    <button type="submit" class="btn-primary" id="calc-submit">
                        Отримати точний розрахунок &rarr;
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>