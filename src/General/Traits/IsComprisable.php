<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use KuzyT\Halfdream\General\Page\PageElement;

/**
 * Trait IsComprisable
 * @package KuzyT\Halfdream\General\Traits
 */
trait IsComprisable
{
    /**
     * @var PageElement[]
     */
    protected $pageElements = [];

    /**
     * @param PageElement|array $pageElement
     * @param bool $clean
     * @return $this
     */
    public function comprise($pageElement, $clean = false) {
        if ($clean) {
            $this->pageElements = [];
        }

        if (is_array($pageElement)) {
            foreach ($pageElement as $element) {
                $this->comprise($element);
            }
        } elseif ($pageElement) {
            $this->pageElements[] = $pageElement;
        }

        return $this;
    }

    /**
     * @return PageElement[]
     */
    public function comprised() {
        return $this->pageElements;
    }

    /**
     * @return bool
     */
    public function hasComprised() {
        return !!count($this->pageElements);
    }
}