<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 17.02.2019
 */

return [
    /**
     * Indicates if some fields are json fields id DB.
     * If you use MySQL, you need 5.7 version for that.
     * For MySQL 5.6 use false.
     */
    'db_json' => true,
    /**
     * Used Locales
     */
    'locale' => [
        /**
         * Usually equals app.fallback_locale
         */
        'default' => 'en',
        /**
         * Enable multilang system. If disabled, only default will shown.
         * ! DB optimized to use system as multilang, in one-lang system it will be less effective. !
         */
        'multi' => true,
        /**
         * List of used languages. Default is certainly en and ru (for developer's development).
         */
        'list' => ['en', 'ru'],
        /**
         * There is no direct match between ISO 639(languages codes) and ISO 3166 (countries codes).
         * But for pretty flags near languages label, there is a dictionary for that.
         * If it is empty, Halfdream will use a language code. But there can be no correct image for that.
         * Here are some help info (for used languages in countries)
         * https://wiki.openstreetmap.org/wiki/Nominatim/Country_Codes
         *
         * @see \Halfdream::countryByLocale($locale)
         */
        'countries' => [
            'en' => 'gb',
            'ru' => 'ru'
        ]
    ],

    /**
     * Enable or disable registration. TODO
     */
    'registration' => false,

    /**
     * Use mix manifest for css & js
     */
    'mix' => false,

    /**
     * Admin Panel settings
     */
    'admin' => [
        /**
         * Title in navbar.
         */
        'title' => 'HalfDream',
        'roles' => [
            /**
             * Roles with access to admin panel. That roles will be created with halfdream:install command.
             */
            'access' => ['admin', 'superadmin'],
            /**
             * Role with full access. It can be assing with halfdream:admin command.
             * Must be in upper 'access' array too.
             */
            'superadmin' => 'superadmin',
        ],
        /**
         * Route uri address
         */
        'route' => 'admin',
        /**
         * Default items per table page. Null or 0 for unlimited.
         */
        'table_paginate' => 25,
        /**
         * Duration for toast messages in ms
         */
        'messages_duration' => 3000,
        /**
         * Default image for display as empty image in admin area.
         */
        'default_image' => '/images/vendor/halfdream/hd.svg'
    ],



    /**
     * Image and files uploads setting
     */
    'uploads' => [
        /**
         * Storage disk from filesystems.php
         */
        'storage' => 'public',
        /**
         * Images settings
         */
        'images' => [
            /**
             * Path for images
             */
            'path' => 'images',
            /**
             * Thumbnails options.
             */
            'thumbnails' => [
                'path' => 'thumbnails',
                /**
                 * Default Thumbnail size. Square thumbnails are used in Admin panel.
                 * But you can make your own sizes and give it to function
                 * thumbnail()
                 */
                'size' => [
                    'width' => 768,
                    'height' => 768
                ],
                /**
                 * Autocreate thumbnails if they not exists. Used in thumbnail().
                 * Use it only if nessesary (maybe if your changing default sizes and want
                 * them created new sizes, or you deleted your thumbnails folder),
                 * because if true, function will check if thumnail exists all over the site this
                 * function used.
                 * For better performance must be false.
                 */
                'autocreate' => true
            ]
        ],
        /**
         * Different files
         */
        'files' => [
            'path' => 'uploads'
        ]
    ],

    /**
     * Settings for front end
     */
    'front' => [
        //todo - variables will be moved to settings in future
        /**
         * Website title
         */
        'title' => 'HalfDream',
        /**
         * Website logo
         */
        'logo' => '/images/vendor/halfdream/hd.svg',
        /**
         * Website description
         */
        'description' => 'HalfDream',
        /**
         * Website keywords
         */
        'keywords' => 'HalfDream, KuzyT',
        /**
         * Website author
         */
        'author' => 'KuzyT',
        /**
         * Website revisit after
         */
        'revisit_after' => '15 days',
        /**
         * Website robots
         */
        'robots' => 'index,follow',
        /**
         * Website og:type
         */
        'og_type' => 'website',
        /**
         * Default avatar
         */
        'default_avatar' => '/images/vendor/halfdream/hd-avatar.svg'
    ],

    /**
     * Setting for special modules
     */
    'modules' => [
        /**
         * Blog module
         */
        'post' => [
            /**
             * Posts per page
             */
            'per_page' => 5
        ],
        /**
         * Category module
         */
        'category' => [
            'per_page' => 5
        ],
        /**
         * Icons module
         */
        'icons' => [
            /**
             * Path to JS, generated by php artisan halfdream:icons
             */
            'js_path' => 'resources/js/icons.js',
            /**
             * Libraries from npm
             */
            'library' => [
                /**
                 * You must have a license for using Font Awesome Pro version, so default is free.
                 */
                'free' => [
                    'fas' => '@fortawesome/free-solid-svg-icons',
                    'far' => '@fortawesome/free-regular-svg-icons',
                    'fab' => '@fortawesome/free-brands-svg-icons'
                ],
                'pro' => [
                    'fas' => '@fortawesome/pro-solid-svg-icons',
                    'far' => '@fortawesome/pro-regular-svg-icons',
                    'fal' => '@fortawesome/pro-light-svg-icons',
                    'fab' => '@fortawesome/free-brands-svg-icons'
                ]
            ],
            /**
             * Use pro Font Awesome version. You must have a license for it.
             */
            'pro' => false
        ]
    ],

    /**
     * For mobile navigation.
     */
    'theme_color' => '#c9e3c8'

];
