<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 22.05.2019
 */

return [
    'title' => [
        'fallback' => 'Иконки', // используется, если нужный ключ пуст
        'menu' => 'Иконки',
        'display' => 'Список иконок',
        'edit' => 'Редактировать иконку',
        'create' => 'Создать новую иконку',
    ],

    'model' => [
        'id' => '#',
        'title' => 'Название',
        'icon' => 'Иконка',
        'key' => 'Ключ',
        'type' => 'Тип',
        'svg' => 'SVG',
        'image' => 'Изображение'
    ],

    'type' => [
        'fas' => 'Font Awesome Solid',
        'far' => 'Font Awesome Regular',
        'fal' => 'Font Awesome Light',
        'fab' => 'Font Awesome Brands',
        'svg' => 'SVG',
        'image' => 'Изображение'
    ],
];
