<?php
/**
 * Footer template part
 */
$content = PrintFactory_Content::get();
$header_contacts = PrintFactory_Content::get_section('header.contacts');
$logo_text = $content['header']['logo_text'] ?? 'PRINT FACTORY';
?>

<footer id="contact" class="site-footer">
    <div class="container container-wide">
        <div class="footer-inner">
            <!-- Logo Section -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                    <span class="footer-logo-icon">
                        <svg width="20" height="20" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4L4 10L16 16L28 10L16 4Z" fill="currentColor" />
                            <path d="M4 16L16 22L28 16" stroke="currentColor" stroke-opacity="0.6" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 22L16 28L28 22" stroke="currentColor" stroke-opacity="0.4" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="footer-logo-text">
                        <?php echo esc_html($logo_text); ?>
                    </span>
                </a>
            </div>

            <!-- Address Section -->
            <div class="footer-info">
                <span class="footer-info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <?php echo esc_html($content['contact']['address']); ?>
                </span>
            </div>

            <!-- Links Section -->
            <div class="footer-nav">
                <a href="#about" class="footer-link">Про нас</a>
                <a href="#price" class="footer-link">Ціни</a>
                <a href="#contact" class="footer-link">Контакти</a>
                <a href="#" class="footer-link footer-policy">Політика конфіденційності</a>
            </div>

            <!-- Copyright Section -->
            <div class="footer-copyright">
                <span>
                    <?php echo esc_html($content['footer']['copyright']); ?>
                </span>
            </div>
        </div>
    </div>
</footer>

<?php get_template_part('template-parts/background-traveler'); ?>

<?php wp_footer(); ?>
</body>

</html>