<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 13.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasType
 * @package KuzyT\Halfdream\General\Traits
 * @property string $type Can be added or not.
 */
trait HasType
{
    /**
     * @var mixed
     */
    protected $_type;

    /**
     * @return mixed
     */
    public function getType() {
        if (empty($this->_type) && property_exists($this, 'type')) {
            return $this->type;
        }

        return $this->_type;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type) {
        $this->_type = $type;
        return $this;
    }
}