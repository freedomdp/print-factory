# Робота з контентом через JSON

## Чому JSON замість ACF/Meta Box?

✅ **Переваги:**
- Повний контроль над даними
- Версіонування через Git
- Швидке редагування в IDE
- Немає проблем з базою даних
- Легко експортувати/імпортувати
- Можна використовувати коментарі (через JSONC)

❌ **Проблеми ACF/Meta Box:**
- Дані то попадають в БД, то ні
- Складна структура в БД
- Важко версіонувати
- Важко мігрувати між середовищами

---

## Структура файлів

```
wordpress/wp-content/themes/print-factory/
├── content.json                    # Весь контент сайту
├── inc/
│   └── content-helper.php          # Клас для роботи з JSON
└── functions.php                   # Підключення хелпера
```

---

## Використання в шаблонах

### Приклад 1: Hero слайдер

```php
<?php
// В template-parts/section-hero.php
$slides = PrintFactory_Content::get_hero_slides();

foreach ($slides as $slide): ?>
    <div class="hero-slide">
        <h2><?php echo esc_html($slide['title']); ?></h2>
        <p><?php echo esc_html($slide['subtitle']); ?></p>
        <a href="#" class="cta-button">
            <?php echo esc_html($slide['cta_text']); ?>
        </a>
    </div>
<?php endforeach; ?>
```

### Приклад 2: About статистика

```php
<?php
// В template-parts/section-about.php
$stats = PrintFactory_Content::get_about_stats();

foreach ($stats as $stat): ?>
    <div class="stat-item">
        <div class="stat-number"><?php echo esc_html($stat['number']); ?></div>
        <div class="stat-label"><?php echo esc_html($stat['label']); ?></div>
    </div>
<?php endforeach; ?>
```

### Приклад 3: FAQ

```php
<?php
// В template-parts/section-faq.php
$faq_items = PrintFactory_Content::get_faq();

foreach ($faq_items as $item): ?>
    <div class="faq-item">
        <h3 class="faq-question"><?php echo esc_html($item['question']); ?></h3>
        <div class="faq-answer"><?php echo esc_html($item['answer']); ?></div>
    </div>
<?php endforeach; ?>
```

### Приклад 4: Довільний ключ

```php
<?php
// Отримати будь-які дані за ключем
$site_name = PrintFactory_Content::get_section('site.name');
$phone = PrintFactory_Content::get_section('contact.phone');
$hero_title = PrintFactory_Content::get_section('hero.slides.0.title');
?>
```

---

## Редагування контенту

### Через IDE (рекомендовано)

1. Відкрити `content.json` в IDE
2. Відредагувати потрібні дані
3. Зберегти файл
4. Перезавантажити сторінку

### Через FTP/SFTP

1. Завантажити `content.json`
2. Відредагувати локально
3. Завантажити назад на сервер

---

## Додавання нових секцій

### Крок 1: Додати дані в content.json

```json
{
  "new_section": {
    "title": "Нова секція",
    "items": [
      {
        "id": 1,
        "name": "Елемент 1"
      }
    ]
  }
}
```

### Крок 2: Додати метод в content-helper.php (опціонально)

```php
public static function get_new_section()
{
    return self::get_section('new_section.items') ?: [];
}
```

### Крок 3: Використати в шаблоні

```php
<?php
$items = PrintFactory_Content::get_new_section();
foreach ($items as $item): ?>
    <div><?php echo esc_html($item['name']); ?></div>
<?php endforeach; ?>
```

---

## Поради

### 1. Завжди використовуйте esc_html()

```php
// ✅ Правильно
echo esc_html($slide['title']);

// ❌ Неправильно (XSS вразливість)
echo $slide['title'];
```

### 2. Перевіряйте наявність даних

```php
// ✅ Правильно
$slides = PrintFactory_Content::get_hero_slides();
if (!empty($slides)) {
    foreach ($slides as $slide) {
        // ...
    }
}

// ❌ Неправильно (може бути помилка)
foreach (PrintFactory_Content::get_hero_slides() as $slide) {
    // ...
}
```

### 3. Використовуйте коментарі в JSON

```json
{
  "hero": {
    "_comment": "Слайдер на головній сторінці",
    "slides": [...]
  }
}
```

---

## Міграція між середовищами

### Локальна → Продакшн

1. Скопіювати `content.json` з локальної версії
2. Завантажити на продакшн сервер
3. Готово! Немає проблем з БД

### Git

```bash
git add wordpress/wp-content/themes/print-factory/content.json
git commit -m "Update hero slides"
git push
```

---

## Backup

### Автоматичний (через Git)

Всі зміни в `content.json` автоматично версіонуються через Git.

### Ручний

```bash
cp content.json content.json.backup
```

---

## Troubleshooting

### Зміни не відображаються

1. Перевірити синтаксис JSON (через jsonlint.com)
2. Очистити кеш WordPress
3. Перевірити права доступу до файлу (644)

### Помилка JSON

```bash
# Перевірити синтаксис
php -r "json_decode(file_get_contents('content.json'));"
```

---

## Приклад повної секції

```php
<?php
// template-parts/section-services.php
$services = PrintFactory_Content::get_services();
?>

<section id="services" class="services-section">
    <div class="container">
        <h2>Наші послуги</h2>
        
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
                <div class="service-card" data-service="<?php echo esc_attr($service['id']); ?>">
                    <div class="service-icon">
                        <?php echo $service['icon']; ?>
                    </div>
                    <h3><?php echo esc_html($service['title']); ?></h3>
                    <p><?php echo esc_html($service['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
```
