<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 23.04.2019
 */

return [
    'title' => [
        'fallback' => 'Posts', // used if one of other keys is empty.
        'menu' => 'Blog',
        'display' => 'Posts list',
        'edit' => 'Edit existing post',
        'create' => 'Create new post',
        'front' => 'Blog'
    ],

    'model' => [
        'id' => '#',
        'user' => 'Author',
        'title' => 'Title',
        'image' => 'Image',
        'gallery' => 'Gallery',
        'content' => 'Content',
        'category' => 'Category',
        'status' => 'Status',
        'created_at' => 'Created Date',
        'published_at' => 'Published Date'
    ],

    'empty' => 'Blog is empty now.',
];
