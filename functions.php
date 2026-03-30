<?php
/**
 * Print Factory Theme Functions
 *
 * Файл структуровано: основний функціонал винесено в папку /inc/
 */

// 1. Дизайн-токени (CSS змінні з JSON)
require_once get_template_directory() . '/inc/design-tokens.php';

// 2. Хелпери для контенту (content.json)
require_once get_template_directory() . '/inc/content-helper.php';

// 3. Основні налаштування теми
require_once get_template_directory() . '/inc/setup.php';

// 4. Підключення стилів та скриптів
require_once get_template_directory() . '/inc/enqueue.php';

// 5. Оптимізація та безпека
require_once get_template_directory() . '/inc/security.php';

// 6. AJAX обробники (форми, калькулятор)
require_once get_template_directory() . '/inc/ajax-handlers.php';
