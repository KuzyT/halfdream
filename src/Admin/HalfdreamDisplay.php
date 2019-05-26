<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.02.2019
 */

namespace KuzyT\Halfdream\Admin;

use KuzyT\Halfdream\General\Traits\IsGeneratable;
use KuzyT\Halfdream\Admin\Display\Table;

/**
 * Class HalfdreamDisplay
 * @package KuzyT\Halfdream\Admin
 *
 * @method static Table table() Table constructor.
 */
class HalfdreamDisplay
{
    use IsGeneratable;

    /**
     * @var array
     */
    protected static $classes = [
        'table' => Table::class
    ];
}