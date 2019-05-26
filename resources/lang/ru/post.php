<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 23.04.2019
 */

return [
    'title' => [
        'fallback' => 'Записи', // используется, если нужный ключ пуст
        'menu' => 'Блог',
        'display' => 'Список записей',
        'edit' => 'Редактировать запись',
        'create' => 'Создать новую запись',
        'front' => 'Блог'
    ],

    'model' => [
        'id' => '#',
        'user' => 'Автор',
        'title' => 'Название',
        'image' => 'Изображение',
        'gallery' => 'Галерея',
        'content' => 'Содержимое',
        'category' => 'Категория',
        'status' => 'Статус',
        'created_at' => 'Дата создания',
        'published_at' => 'Дата публикации'
    ],

    'empty' => 'Нет записей в блоге.',
];
