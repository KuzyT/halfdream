<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasWidth
 * @package KuzyT\Halfdream\General\Traits
 * @property string $width Can be added or not.
 */
trait HasWidth
{
    /**
     * @var null|string
     */
    protected $_width = null;

    /**
     * @return string
     */
    public function getWidth() {
        if (empty($this->_width) && property_exists($this, 'width')) {
            return $this->width;
        }

        return $this->_width;
    }

    /**
     * @param string|null $width
     * @return $this
     */
    public function setWidth($width) {
        $this->_width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function renderWidth() {
        if ($this->getWidth()) {
            return ' width="' . $this->getWidth() . '"';
        } else {
            return '';
        }
    }
}