<?php
/**
 * Header Logo "Brick"
 */
$header_data = PrintFactory_Content::get_section('header');
$logo_text = $header_data['logo_text'] ?? 'PRINT FACTORY';
?>

<div class="header-logo">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
        <span class="logo-icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 4L4 10L16 16L28 10L16 4Z" fill="white" />
                <path d="M4 16L16 22L28 16" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M4 22L16 28L28 22" stroke="rgba(255,255,255,0.4)" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </span>
        <span class="logo-text"><?php echo esc_html($logo_text); ?></span>
    </a>
</div>