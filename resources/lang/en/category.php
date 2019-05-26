<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 26.04.2019
 */

return [
    'title' => [
        'fallback' => 'Categories', // used if one of other keys is empty.
        'menu' => 'Categories',
        'display' => 'Categories list',
        'edit' => 'Edit existing category',
        'create' => 'Create new category',
        'front' => 'Categories'
    ],

    'model' => [
        'id' => '#',
        'title' => 'Title',
        'content' => 'Content',
        'parent' => 'Parent'
    ],

    'empty' => 'No categories.',
];
