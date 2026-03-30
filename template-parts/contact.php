<?php
/**
 * Template part for displaying Contact section
 */
$content = $args['content'] ?? [];
?>
<section id="contact" class="section-padding">
    <div class="container text-center">
        <h2 class="animate-header">
            <?php echo esc_html($content['contact']['title']); ?>
        </h2>
        <p class="mb-4 text-xl opacity-80">
            <?php echo esc_html($content['contact']['address']); ?>
        </p>

        <div class="mt-4 d-flex flex-column gap-sm align-items-center">
            <?php
            // Use header contacts as the single source of truth
            $header_contacts = \PrintFactory_Content::get_section('header.contacts');
            ?>
            <a href="mailto:<?php echo esc_attr($header_contacts['email']); ?>"
                class="text-primary text-decoration-none font-bold text-xl">
                <?php echo esc_html($header_contacts['email_label']); ?>
            </a>
            <a href="<?php echo esc_attr($header_contacts['phone_link']); ?>"
                class="text-white text-decoration-none text-xl">
                <?php echo esc_html($header_contacts['phone']); ?>
            </a>
        </div>

    </div>
</section>