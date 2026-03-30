<?php
/**
 * AJAX обробники форм (Калькулятор тощо)
 */

function print_factory_handle_calculator()
{
    // Sanitize and validate
    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $material = sanitize_text_field($_POST['material'] ?? '');
    $width = sanitize_text_field($_POST['width'] ?? '');
    $height = sanitize_text_field($_POST['height'] ?? '');
    $depth = sanitize_text_field($_POST['depth'] ?? '');
    $infill = sanitize_text_field($_POST['infill'] ?? '');
    $qty = sanitize_text_field($_POST['qty'] ?? '');
    $messenger = sanitize_text_field($_POST['messenger'] ?? '');
    $comment = sanitize_textarea_field($_POST['comment'] ?? '');
    $total_price = sanitize_text_field($_POST['total_price'] ?? '');

    $to = 'sergey.parubets@gmail.com';
    $subject = '🚀 Нове замовлення: Розрахунок 3D друку від ' . $name;

    // Build HTML Message
    $message = "<html><body>";
    $message .= "<h2>Новий запит з калькулятора PRINT-FACTORY</h2>";
    $message .= "<table style='width: 100%; border-collapse: collapse;'>";
    $message .= "<tr style='background: #f8f8f8;'><td style='padding: 10px; border: 1px solid #ddd;'><b>Клієнт:</b></td><td style='padding: 10px; border: 1px solid #ddd;'>$name</td></tr>";
    $message .= "<tr><td style='padding: 10px; border: 1px solid #ddd;'><b>Телефон:</b></td><td style='padding: 10px; border: 1px solid #ddd;'>$phone</td></tr>";
    $message .= "<tr style='background: #f8f8f8;'><td style='padding: 10px; border: 1px solid #ddd;'><b>Зв'язок через:</b></td><td style='padding: 10px; border: 1px solid #ddd;'>$messenger" . ($email ? " ($email)" : "") . "</td></tr>";
    $message .= "</table>";

    $message .= "<h3>Технічні деталі:</h3>";
    $message .= "<table style='width: 100%; border-collapse: collapse;'>";
    $message .= "<tr style='background: #f8f8f8;'><td style='padding: 10px; border: 1px solid #ddd;'>Матеріал:</td><td style='padding: 10px; border: 1px solid #ddd;'>$material</td></tr>";
    $message .= "<tr><td style='padding: 10px; border: 1px solid #ddd;'>Розміри (ШхВхГ):</td><td style='padding: 10px; border: 1px solid #ddd;'>{$width} x {$height} x {$depth} мм</td></tr>";
    $message .= "<tr style='background: #f8f8f8;'><td style='padding: 10px; border: 1px solid #ddd;'>Заповнення:</td><td style='padding: 10px; border: 1px solid #ddd;'>$infill%</td></tr>";
    $message .= "<tr><td style='padding: 10px; border: 1px solid #ddd;'>Кількість:</td><td style='padding: 10px; border: 1px solid #ddd;'>$qty шт</td></tr>";
    $message .= "<tr style='background: #e6fffb; font-weight: bold;'><td style='padding: 10px; border: 1px solid #ddd;'>Орієнтовна ціна:</td><td style='padding: 10px; border: 1px solid #ddd; color: #00897b;'>$total_price</td></tr>";
    $message .= "</table>";

    if ($comment) {
        $message .= "<h3>Коментар клієнта:</h3>";
        $message .= "<div style='padding: 15px; background: #fffde7; border: 1px solid #fff59d;'>$comment</div>";
    }

    $message .= "<br><hr><p style='font-size: 12px; color: #666;'>Це повідомлення було надіслано автоматично з сайту Print Factory.</p>";
    $message .= "</body></html>";

    $headers = array('Content-Type: text/html; charset=UTF-8');

    $attachments = array();
    // Handle file upload
    if (!empty($_FILES['file']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    $sent = wp_mail($to, $subject, $message, $headers, $attachments);

    if (!$sent) {
        // Log local error for debugging
        error_log("WP_MAIL ERROR: Combined order from $name failed to send to $to");
    }

    // Clean up
    foreach ($attachments as $file) {
        @unlink($file);
    }

    if ($sent) {
        wp_send_json_success('Дякуємо! Ваша заявка отримана.');
    } else {
        wp_send_json_error('Помилка при відправці пошти.');
    }
}
add_action('wp_ajax_handle_calculator', 'print_factory_handle_calculator');
add_action('wp_ajax_nopriv_handle_calculator', 'print_factory_handle_calculator');
