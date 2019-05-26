<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait IsGeneratable.
 * @package KuzyT\Halfdream\General\Traits
 */
trait IsGeneratable
{
    /**
     * @var array
     */
    protected static $classesList = [];

    protected static function getClasses() {
        if (property_exists(static::class, 'classes')) {
            // This order helps to redeclare class for helpers by addClass function
            return array_merge(static::$classes, static::$classesList);
        }

        return static::$classesList;
    }

    /**
     * Add or replace custom Class.
     * @param string $alias
     * @param string $class
     */
    public static function addClass(string $alias, string $class) {
        static::$classesList[$alias] = $class;
    }

    /**
     * @param $name
     * @param $arguments
     * @return Object
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        if (key_exists($name, static::getClasses())) {
            $class = static::getClasses()[$name];
            return new $class(...$arguments);
        } else {
            throw new \Exception("No Class with name '$name' exists.");
        }
    }
}