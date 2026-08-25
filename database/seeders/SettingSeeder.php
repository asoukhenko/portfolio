<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'label' => 'Имя в шапке', 'value' => 'Александра'],
            ['key' => 'site_role', 'label' => 'Профессия / Должность', 'value' => 'HEAD OF WEB DEV / SENIOR PM'],
            ['key' => 'btn_contact_text', 'label' => 'Текст кнопки связи', 'value' => 'Написать'],
            ['key' => 'contact_email', 'label' => 'Email для связи', 'value' => 'alexandra@example.com'],
            ['key' => 'hero_badge', 'label' => 'Тэг над заголовком', 'value' => 'Управленин & Стратегия'],
            ['key' => 'hero_title', 'label' => 'Главный заголовок', 'value' => 'Создаю предсказуемые процессы и сильные web-продукты для бизнеса.'],
            ['key' => 'hero_description', 'label' => 'Описание под заголовком', 'value' => 'Руковожу командами разработки полного цикла. Оцифровываю хаос, защищаю бюджеты, внедряю прозрачный трекинг и гарантирую сдачу IT-проектов в срок.'],
            ['key' => 'stat_1_value', 'label' => 'Метрика 1 (цифра)', 'value' => '12+ лет'],
            ['key' => 'stat_1_label', 'label' => 'Метрика 1 (подпись)', 'value' => 'ОПЫТА РУКОВОДСТВА ОТДЕЛОМ'],
            ['key' => 'stat_2_value', 'label' => 'Метрика 2 (цифра)', 'value' => '100+'],
            ['key' => 'stat_2_label', 'label' => 'Метрика 2 (подпись)', 'value' => 'СДАННЫХ ПРОЕКТОВ БЕЗ ШТРАФОВ'],
            ['key' => 'stat_3_value', 'label' => 'Метрика 3 (цифра)', 'value' => '100%'],
            ['key' => 'stat_3_label', 'label' => 'Метрика 3 (подпись)', 'value' => 'КОНТРОЛЯ В БИТРИКС24 & АНАЛИТИКА'],
            ['key' => 'cases_title', 'label' => 'Заголовок секции проектов', 'value' => 'Избранные кейсы'],
            ['key' => 'cases_subtitle', 'label' => 'Подзаголовок секции проектов', 'value' => 'Реализованные проекты, задачи и бизнес-результаты'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}