<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Page;

use Illuminate\Database\Eloquent\Model;
use KuzyT\Halfdream\General\Interfaces\Comprisable;
use KuzyT\Halfdream\General\Traits\HasView;

/**
 * Class PageElement.
 * @package KuzyT\Halfdream\General\Page
 */
abstract class PageElement
{
    use HasView;
}
