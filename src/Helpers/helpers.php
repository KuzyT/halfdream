<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 19.02.2019
 */

if (!function_exists('setting')) {
    /**
     * Settings.
     *
     * @param $key
     * @param null $default
     * @return string
     */
    function setting($key, $default = null)
    {
        return KuzyT\Halfdream\Facades\Halfdream::setting($key, $default);
    }
}

if (!function_exists('locale')) {
    /**
     * Get current app locale. May have parameter to set it.
     * @param string|null $locale
     * @return string
     */
    function locale($locale = null)
    {
        return KuzyT\Halfdream\Facades\Halfdream::locale($locale);
    }
}

if (!function_exists('menu')) {
    /**
     * @param $key
     * @return \Illuminate\Support\Collection
     */
    function menu($key)
    {
        return KuzyT\Halfdream\Facades\Halfdream::menu($key);
    }
}

if (!function_exists('icon')) {
    /**
     * @param $key
     * @return null|\KuzyT\Halfdream\Models\Icon
     */
    function icon($key)
    {
        return KuzyT\Halfdream\Facades\Halfdream::icon($key);
    }
}

if (!function_exists('image')) {
    /**
     * @param $file
     * @param string $default
     * @return string
     */
    function image($file, $default = '')
    {
        return KuzyT\Halfdream\Facades\Halfdream::image($file, $default);
    }
}

if (!function_exists('thumbnail')) {
    /**
     * @param $file
     * @param int|null $width
     * @param int|null $height
     * @param bool|null $autocreate
     * @param string $default
     * @return string
     */
    function thumbnail($file, $width = null, $height = null, $autocreate = null, $default = '')
    {
        return KuzyT\Halfdream\Facades\Halfdream::thumbnail($file, $width, $height, $autocreate, $default);
    }
}

if (! function_exists('__route')) {
    /**
     * Generate the URL to a named route.
     * Translatable version.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function __route($name, $parameters = [], $absolute = true)
    {
        if (\Halfdream::multiLocale()) {
            $parameters = array_merge(['locale' => locale()], $parameters);
        }
        return route($name, $parameters, $absolute);
    }
}