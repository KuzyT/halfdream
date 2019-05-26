<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasMinSize
 * @package KuzyT\Halfdream\General\Traits
 * @property mixed $minSize Can be added or not.
 */
trait HasMinSize
{
    /**
     * @var mixed Min size for value, null or 0 for unlimited.
     */
    protected $_minSize;

    /**
     * @return mixed
     */
    public function getMinSize() {
        if (empty($this->_minSize) && property_exists($this, 'minSize')) {
            return $this->minSize;
        }

        return $this->_minSize;
    }

    /**
     * @param mixed $minSize
     * @return $this
     */
    public function setMinSize($minSize) {
        $this->_minSize = $minSize;
        return $this;
    }

    /**
     * @param &array $rules
     */
    public function addRuleMinSize(&$rules)
    {
        if ($this->getMinSize()) {
            $rules[] = 'min:' . $this->getMinSize(); // validate const equal to form const
        }
    }
}