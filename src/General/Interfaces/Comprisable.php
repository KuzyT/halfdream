<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Interfaces;

use KuzyT\Halfdream\General\Page\PageElement;

interface Comprisable
{
    /**
     * @param PageElement|array $pageElement
     * @param bool $clean
     * @return $this
     */
    public function comprise($pageElement, $clean = false);

    /**
     * @return PageElement[]
     */
    public function comprised();
}