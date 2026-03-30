<?php
/**
 * Header Contacts Button "Brick"
 */
$contacts = PrintFactory_Content::get_section('header.contacts');
$raw_phone_icon = $contacts['phone_icon'] ?? '';
// Force theme icon if DB path is empty or points to old uploads
$phone_icon_url = (empty($raw_phone_icon) || strpos($raw_phone_icon, 'uploads/2026/02') !== false) 
    ? get_template_directory_uri() . '/assets/images/icons/phone.svg' 
    : $raw_phone_icon;
?>

<div class="header-contacts-trigger">
    <button class="contacts-circle-btn" id="contacts-drawer-toggle" aria-label="Відкрити контакти">
        <span class="phone-icon">
            <img src="<?php echo esc_url($phone_icon_url); ?>" alt="Phone" width="24" height="24">
        </span>
    </button>
</div>