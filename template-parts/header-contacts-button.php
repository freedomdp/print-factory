<?php
/**
 * Header Contacts Button "Brick"
 */
$contacts = PrintFactory_Content::get_section('header.contacts');
?>

<div class="header-contacts-trigger">
    <button class="contacts-circle-btn" id="contacts-drawer-toggle" aria-label="Відкрити контакти">
        <span class="phone-icon">
            <img src="<?php echo esc_url($contacts['phone_icon'] ?? ''); ?>" alt="Phone" width="24" height="24">
        </span>
    </button>
</div>