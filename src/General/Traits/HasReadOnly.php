<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 19.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasReadOnly
 * @package KuzyT\Halfdream\General\Traits
 * @property bool $readOnly Can be added or not.
 */
trait HasReadOnly
{
    /**
     * @var bool
     */
    protected $_readOnly = false;

    /**
     * @return bool
     */
    public function getReadOnly() {
        if (empty($this->_readOnly) && property_exists($this, 'readOnly')) {
            return $this->readOnly;
        }

        return $this->_readOnly;
    }

    /**
     * @param $readOnly
     * @return $this
     */
    public function setReadOnly($readOnly) {
        $this->_readOnly = $readOnly;
        return $this;
    }

    /**
     * @param bool $readOnly
     * @return HasReadOnly
     */
    public function readOnly($readOnly = true) {
        return $this->setReadOnly($readOnly);
    }
}