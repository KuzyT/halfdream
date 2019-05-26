<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 13.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;


/**
 * Trait HasSize
 * @package KuzyT\Halfdream\General\Traits
 * @property string $size Can be added or not.
 */
trait HasSize
{
    /**
     * @var mixed
     */
    protected $_size;

    /**
     * @return mixed
     */
    public function getSize() {
        if (empty($this->_size) && property_exists($this, 'size')) {
            return $this->size;
        }

        return $this->_size;
    }

    /**
     * @param mixed $size
     * @return $this
     */
    public function setSize($size) {
        $this->_size = $size;
        return $this;
    }
}