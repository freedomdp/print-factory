<?php
/**
 * Хелпер для роботи з content.json
 */

class PrintFactory_Content
{
    private static $content = null;

    /**
     * Завантажити content.json
     */
    public static function get()
    {
        if (self::$content === null) {
            $file = get_template_directory() . '/content.json';
            if (file_exists($file)) {
                $json = file_get_contents($file);
                self::$content = json_decode($json, true);
            } else {
                self::$content = [];
            }
        }
        return self::$content;
    }

    /**
     * Отримати дані за ключем
     * Приклад: PrintFactory_Content::get_section('hero.slides')
     */
    public static function get_section($key)
    {
        $content = self::get();
        $keys = explode('.', $key);

        foreach ($keys as $k) {
            if (isset($content[$k])) {
                $content = $content[$k];
            } else {
                return null;
            }
        }

        return $content;
    }

    /**
     * Отримати Hero слайди
     */
    public static function get_hero_slides()
    {
        return self::get_section('hero.slides') ?: [];
    }

    /**
     * Отримати статистику About
     */
    public static function get_about_stats()
    {
        return self::get_section('about.stats') ?: [];
    }

    /**
     * Отримати послуги
     */
    public static function get_services()
    {
        return self::get_section('services') ?: [];
    }

    /**
     * Отримати FAQ
     */
    public static function get_faq()
    {
        return self::get_section('faq.items') ?: [];
    }

    /**
     * Отримати контакти
     */
    public static function get_contact()
    {
        return self::get_section('contact') ?: [];
    }
}
