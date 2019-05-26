<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 12.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasCssClasses
 * @package KuzyT\Halfdream\General\Traits
 * @property array $cssClasses Can be added or not.
 */
trait HasCssClasses
{
    /**
     * @var array
     */
    protected $_cssClasses = [];

    /**
     * @return array
     */
    public function getCssClasses() {
        if (property_exists($this, 'cssClasses')) {
            // This order helps to redeclare class for helpers by addCssClass function
            return array_merge($this->cssClasses, $this->_cssClasses);
        }

        return $this->_cssClasses;
    }

    /**
     * @param string|array $cssClass
     * @return $this
     */
    public function addCssClass($cssClass) {
        // todo - add an unique check and delete class ability
        if (is_array($cssClass)) {
            foreach ($cssClass as $singleCssClass) {
                $this->addCssClass($singleCssClass);
            }
        } else {
            if (!$this->hasCssClass($cssClass)) {
                $this->_cssClasses[] = $cssClass;
            }
        }

        return $this;
    }

    /**
     * Delete exist css Class.
     * @param string $cssClass
     */
    public function deleteCssClass($cssClass) {
        if ($this->hasCssClass($cssClass)) {
            // Deleting from both arrays

            if (property_exists($this, 'cssClasses') && (($key = array_search($cssClass, $this->cssClasses)) !== false)) {
                unset($this->cssClasses[$key]);
            }

            if (($key = array_search($cssClass, $this->_cssClasses)) !== false) {
                unset($this->_cssClasses[$key]);
            }
        }
    }

    /**
     * @param string $cssClass
     * @return bool
     */
    public function hasCssClass($cssClass) {
        return in_array($cssClass, $this->getCssClasses());
    }

    /**
     * @return string
     */
    public function renderCssClasses() {
        if ($this->getCssClasses()) {
            return ' class="' . implode(' ', $this->getCssClasses()) . '"';
        } else {
            return '';
        }
    }
}