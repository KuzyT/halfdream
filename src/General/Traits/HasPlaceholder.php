<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasPlaceholder
 * @package KuzyT\Halfdream\General\Traits
 * @property string $placeholder Can be added or not.
 */
trait HasPlaceholder
{
    /**
     * @var string
     */
    protected $_placeholder;

    /**
     * @return string
     */
    public function getPlaceholder() {
        if (empty($this->_placeholder) && property_exists($this, 'placeholder')) {
            return $this->placeholder;
        }

        return $this->_placeholder;
    }

    /**
     * @param string $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder) {
        $this->_placeholder = $placeholder;
        return $this;
    }
}