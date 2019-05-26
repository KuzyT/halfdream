<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasMaxSize
 * @package KuzyT\Halfdream\General\Traits
 * @property mixed $maxSize Can be added or not.
 */
trait HasMaxSize
{
    /**
     * @var mixed Max size for value, null or 0 for unlimited.
     */
    protected $_maxSize;

    /**
     * @return mixed
     */
    public function getMaxSize() {
        if (empty($this->_maxSize) && property_exists($this, 'maxSize')) {
            return $this->maxSize;
        }

        return $this->_maxSize;
    }

    /**
     * @param mixed $maxSize
     * @return $this
     */
    public function setMaxSize($maxSize) {
        $this->_maxSize = $maxSize;
        return $this;
    }

    /**
     * @param &array $rules
     */
    public function addRuleMaxSize(&$rules)
    {
        if ($this->getMaxSize()) {
            $rules[] = 'max:' . $this->getMaxSize(); // validate const equal to form const
        }
    }
}