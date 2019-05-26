<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.05.2019
 */

return [
    'title' => [
        'fallback' => 'Menu items', // used if one of other keys is empty.
        'display' => 'Menu items',
        'edit' => 'Edit menu item',
        'create' => 'Create new item',
    ],

    'model' => [
        'id' => '#',
        'menu' => 'Menu',
        'icon' => 'Icon',
        'parent' => 'Parent item',
        'title' => 'Title',
        'url' => 'Url',
        'target' => 'Target',
        'visible' => 'Visible',
        'route' => 'Route name',
        'parameters' => 'Parameters',
        'color' => 'Color',
        'class' => 'Class'
    ],

    'form' => [
        'url' => 'Url (if route is empty)',
        'route' => 'Route',
    ],

    'target' => [
        '_self' => 'Same window',
        '_blank' => 'New window'
    ]
];
