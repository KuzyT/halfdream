<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 12.03.2019
 */

namespace KuzyT\Halfdream\General\Scripts;

use KuzyT\Halfdream\General\Traits\HasView;

class Script
{
    use HasView;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var bool Only one such Script can be added to Script manager.
     */
    protected $single = false;

    /**
     * @return bool
     */
    public function isSingle() {
        return $this->single;
    }

    /**
     * Script constructor.
     */
    public function __construct()
    {
        // For single scripts works only the first time created.
    }
}