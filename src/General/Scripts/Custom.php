<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 12.03.2019
 */

namespace KuzyT\Halfdream\General\Scripts;

use KuzyT\Halfdream\General\Traits\HasContent;

class Custom extends Script
{
    use HasContent;

    /**
     * @var string
     */
    protected $view = 'halfdream::general.scripts.custom';

    public function __construct($content)
    {
        $this->setContent($content);
    }

    /**
     * @return array
     */
    public function getViewData() {
        return ['content' => $this->getContent()];
    }
}