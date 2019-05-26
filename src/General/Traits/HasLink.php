<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 29.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasLink
 * @package KuzyT\Halfdream\General\Traits
 * @property string $link Can be added or not.
 */
trait HasLink
{
    /**
     * @var string
     */
    protected $_link;

    /**
     * @return string
     */
    public function getLink() {
        if (empty($this->_link) && property_exists($this, 'link')) {
            return $this->link;
        }

        return $this->_link;
    }

    /**
     * @param string $link
     * @return $this
     */
    public function setLink($link) {
        $this->_link = $link;
        return $this;
    }
}
