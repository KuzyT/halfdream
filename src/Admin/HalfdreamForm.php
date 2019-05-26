<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 04.03.2019
 */

namespace KuzyT\Halfdream\Admin;

use KuzyT\Halfdream\Admin\Form\DefaultForm;
use KuzyT\Halfdream\General\Traits\IsGeneratable;

/**
 * Class HalfdreamForm
 * @package KuzyT\Halfdream\Admin
 *
 * @method static DefaultForm default() DefaultForm constructor.
 */
class HalfdreamForm
{
    use IsGeneratable;

    /**
     * @var array
     */
    protected static $classes = [
        'default' => DefaultForm::class
    ];
}