<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasLabel
 * @package KuzyT\Halfdream\General\Traits
 * @property string $defaultValue Can be added or not.
 */
trait HasDefaultValue
{
    /**
     * @var mixed
     */
    protected $_defaultValue;

    /**
     * @return mixed
     */
    public function getDefaultValue() {
        if (empty($this->_defaultValue) && property_exists($this, 'defaultValue')) {
            return $this->defaultValue;
        }

        return $this->_defaultValue;
    }

    /**
     * @param mixed $defaultValue
     * @return $this
     */
    public function setDefaultValue($defaultValue) {
        $this->_defaultValue = $defaultValue;
        return $this;
    }
}