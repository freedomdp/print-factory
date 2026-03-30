<?php
/**
 * Header Contacts Drawer (Panel) "Brick"
 */
$contacts = PrintFactory_Content::get_section('header.contacts');
?>

<div class="contacts-drawer" id="contacts-drawer" aria-hidden="true">
    <div class="drawer-header">
        <button class="drawer-back" id="contacts-drawer-close" aria-label="Назад">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5" stroke="var(--text-primary)" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M12 19L5 12L12 5" stroke="var(--text-primary)" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <h2 class="drawer-title">Контакти</h2>
    </div>

    <div class="drawer-content">
        <div class="contact-cards">
            <!-- Телефон -->
            <a href="<?php echo esc_url($contacts['phone_link']); ?>" class="contact-card card-phone">
                <div class="card-icon">
                    <img src="<?php echo esc_url($contacts['phone_icon'] ?? ''); ?>" alt="Phone" width="24" height="24">
                </div>
                <div class="card-info">
                    <span class="card-label">ТЕЛЕФОН</span>
                    <span class="card-value"><?php echo esc_html($contacts['phone']); ?></span>
                </div>
            </a>

            <!-- Telegram -->
            <a href="<?php echo esc_url($contacts['telegram']); ?>" target="_blank" rel="noopener"
                class="contact-card card-telegram">
                <div class="card-icon">
                    <img src="<?php echo esc_url($contacts['telegram_icon'] ?? ''); ?>" alt="Telegram" width="24"
                        height="24">
                </div>
                <div class="card-info">
                    <span class="card-label">TELEGRAM</span>
                    <span class="card-value"><?php echo esc_html($contacts['telegram_label']); ?></span>
                </div>
            </a>

            <!-- Viber -->
            <a href="<?php echo esc_url($contacts['viber']); ?>" class="contact-card card-viber">
                <div class="card-icon">
                    <img src="<?php echo esc_url($contacts['viber_icon'] ?? ''); ?>" alt="Viber" width="24" height="24">
                </div>
                <div class="card-info">
                    <span class="card-label">VIBER</span>
                    <span class="card-value"><?php echo esc_html($contacts['viber_label']); ?></span>
                </div>
            </a>

            <!-- WhatsApp -->
            <a href="<?php echo esc_url($contacts['whatsapp']); ?>" target="_blank" rel="noopener"
                class="contact-card card-whatsapp">
                <div class="card-icon">
                    <img src="<?php echo esc_url($contacts['whatsapp_icon'] ?? ''); ?>" alt="WhatsApp" width="24"
                        height="24">
                </div>
                <div class="card-info">
                    <span class="card-label">WHATSAPP</span>
                    <span class="card-value"><?php echo esc_html($contacts['whatsapp_label']); ?></span>
                </div>
            </a>

            <!-- Email -->
            <a href="mailto:<?php echo esc_attr($contacts['email']); ?>" class="contact-card card-email">
                <div class="card-icon">
                    <img src="<?php echo esc_url($contacts['email_icon'] ?? ''); ?>" alt="Email" width="24" height="24">
                </div>
                <div class="card-info">
                    <span class="card-label">EMAIL</span>
                    <span class="card-value"><?php echo esc_html($contacts['email_label']); ?></span>
                </div>
            </a>
        </div>
    </div>
</div>