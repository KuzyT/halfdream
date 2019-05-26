<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasKey
 * @package KuzyT\Halfdream\General\Traits
 * @property string $key Can be added or not.
 */
trait HasKey
{
    /**
     * @var string
     */
    protected $_key;

    /**
     * @return string
     */
    public function getKey() {
        if (empty($this->_key)) {
            if (property_exists($this, 'key') && !empty($this->key)) {
                return $this->key;
            } elseif (method_exists($this, 'getModelClass') && $this->getModelClass()) {
                // Special for class with HasModelClass Trait
                $modelClass= $this->getModelClass();
                return with(new $modelClass)->getTable();
            }
        }

        return $this->_key;
    }

    /**
     * @param @param string $key
     * @return $this
     */
    public function setKey($key) {
        $this->_key = $key;
        return $this;
    }
}