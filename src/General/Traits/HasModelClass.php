<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasModelClass
 * @package KuzyT\Halfdream\General\Traits
 * @property string $modelClass Can be added or not.
 */
trait HasModelClass
{
    /**
     * @var string
     */
    protected $_modelClass;

    /**
     * @param string $modelClass
     * @return $this
     */
    public function setModelClass(string $modelClass) {
        $this->_modelClass = $modelClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getModelClass() {
        if (empty($this->_modelClass) && property_exists($this, 'modelClass')) {
            return $this->modelClass;
        }

        return $this->_modelClass;
    }
}