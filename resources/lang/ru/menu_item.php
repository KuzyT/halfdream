<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.05.2019
 */

return [
    'title' => [
        'fallback' => 'Элементы меню', // используется, если нужный ключ пуст
        'display' => 'Элементы меню',
        'edit' => 'Редактировать элемент меню',
        'create' => 'Создать новый элемент меню',
    ],

    'model' => [
        'id' => '#',
        'menu' => 'Меню',
        'icon' => 'Иконка',
        'parent' => 'Родительский элемент',
        'title' => 'Название',
        'url' => 'Ссылка',
        'target' => 'Открытие',
        'visible' => 'Видимость',
        'route' => 'Имя роута',
        'parameters' => 'Параметры',
        'color' => 'Цвет',
        'class' => 'Класс'
    ],

    'form' => [
        'url' => 'Ссылка (если роут пуст)',
        'route' => 'Роут',
    ],

    'target' => [
        '_self' => 'В том же окне',
        '_blank' => 'В новом окне'
    ]
];