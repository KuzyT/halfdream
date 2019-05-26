<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasStyle
 * @package KuzyT\Halfdream\General\Traits
 * @property string $style Can be added or not.
 */
trait HasStyle
{
    /**
     * @var null|string
     */
    protected $_style = null;

    /**
     * @return string
     */
    public function getStyle() {
        if (empty($this->_style) && property_exists($this, 'style')) {
            return $this->style;
        }

        return $this->_style;
    }

    /**
     * @param string|null $style
     * @return $this
     */
    public function setStyle($style) {
        $this->_style = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function renderStyle() {
        if ($this->getStyle()) {
            return ' style="' . $this->getStyle() . '"';
        } else {
            return '';
        }
    }
}