<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 19.02.2019
 */

namespace KuzyT\Halfdream\Facades;

use Illuminate\Support\Facades\Facade;

class Halfdream extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'halfdream';
    }
}
