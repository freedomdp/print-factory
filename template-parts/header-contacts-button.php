<?php
/**
 * Header Contacts Button "Brick"
 */
$contacts = PrintFactory_Content::get_section('header.contacts');
$phone_icon_url = !empty($contacts['phone_icon']) ? $contacts['phone_icon'] : get_template_directory_uri() . '/assets/images/icons/phone.svg';
?>

<div class="header-contacts-trigger">
    <button class="contacts-circle-btn" id="contacts-drawer-toggle" aria-label="Відкрити контакти">
        <span class="phone-icon">
            <img src="<?php echo esc_url($phone_icon_url); ?>" alt="Phone" width="24" height="24">
        </span>
    </button>
</div>