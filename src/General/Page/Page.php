<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Page;

use KuzyT\Halfdream\General\Interfaces\Comprisable;
use KuzyT\Halfdream\General\Traits\IsComprisable;
use KuzyT\Halfdream\General\Traits\HasKey;
use KuzyT\Halfdream\General\Traits\HasModelClass;
use KuzyT\Halfdream\General\Traits\HasView;


/**
 * Class Page. Basic class for admin pages - displaying list, editing form, changes settings or custom pages.
 * @package KuzyT\Halfdream\General\Page
 */
abstract class Page implements Comprisable
{
    use IsComprisable, HasModelClass, HasKey, HasView;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        // Default
    }
}