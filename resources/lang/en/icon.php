<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 22.05.2019
 */

return [
    'title' => [
        'fallback' => 'Icons', // used if one of other keys is empty.
        'menu' => 'Icons',
        'display' => 'Icons list',
        'edit' => 'Edit icon',
        'create' => 'Create new icon',
    ],

    'model' => [
        'id' => '#',
        'title' => 'Title',
        'icon' => 'Icon',
        'key' => 'Key',
        'type' => 'Type',
        'svg' => 'SVG',
        'image' => 'Image'
    ],

    'type' => [
        'fas' => 'Font Awesome Solid',
        'far' => 'Font Awesome Regular',
        'fal' => 'Font Awesome Light',
        'fab' => 'Font Awesome Brands',
        'svg' => 'SVG',
        'image' => 'Image'
    ],
];
