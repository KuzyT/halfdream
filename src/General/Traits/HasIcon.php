<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasIcon
 * @package KuzyT\Halfdream\General\Traits
 * @property string $icon Can be added or not.
 */
trait HasIcon
{
    /**
     * @var string
     */
    protected $_icon;

    /**
     * @return string
     */
    public function getIcon() {
        if (empty($this->_icon) && property_exists($this, 'icon')) {
            return $this->icon;
        }

        return $this->_icon;
    }

    /**
     * @return string
     */
    public function getDisplayedIcon() {
        return \Halfdream::prepareFAIcon($this->getIcon());
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function setIcon($icon) {
        $this->_icon = $icon;
        return $this;
    }
}