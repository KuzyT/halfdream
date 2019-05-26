<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 12.03.2019
 */

namespace KuzyT\Halfdream\General\Scripts;


class Locale extends Custom
{
    /**
     * @var bool Only one such Script can be added to Script manager.
     */
    protected $single = true;

    /**
     * @var string
     */
    protected $view = 'halfdream::general.scripts.locale';

    public function __construct($content = '')
    {
        if ($content) {
            $this->setContent($content);
        } else {
            // Default
            $this->setContent(locale());
        }
    }
}