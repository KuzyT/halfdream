<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 06.05.2019
 */

return [
    'title' => [
        'fallback' => 'Pages', // used if one of other keys is empty.
        'menu' => 'Pages',
        'display' => 'Pages list',
        'edit' => 'Edit existing page',
        'create' => 'Create new page'
    ],

    'model' => [
        'id' => '#',
        'title' => 'Title',
        'image' => 'Image',
        'gallery' => 'Gallery',
        'content' => 'Content',
        'parent' => 'Parent',
        'status' => 'Status',
        'created_at' => 'Created Date'
    ]
];