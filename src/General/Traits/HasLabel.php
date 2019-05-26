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
 * @property string $label Can be added or not.
 */
trait HasLabel
{
    /**
     * @var string
     */
    protected $_label;

    /**
     * @var bool
     */
    protected $translateLabel = false;

    /**
     * @return string
     */
    public function getLabel() {
        if (empty($this->_label) && property_exists($this, 'label')) {
            return $this->translateLabel() ? __($this->label) : $this->label;
        }

        return $this->translateLabel() ? __($this->_label) : $this->_label;
    }

    /**
     * @param string $label
     * @param bool $translateLabel
     * @return $this
     */
    public function setLabel($label, $translateLabel = false) {
        $this->_label = $label;
        $this->translateLabel($translateLabel);
        return $this;
    }

    /**
     * @param null|bool $translateLabel
     * @return bool
     */
    public function translateLabel($translateLabel = null) {
        if ($translateLabel !== null) {
            $this->translateLabel = !!$translateLabel;
        }

        return $this->translateLabel;
    }
}
