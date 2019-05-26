<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasOptions
 * @package KuzyT\Halfdream\General\Traits
 * @property array $options Can be added or not.
 */
trait HasOptions
{
    /**
     * @var array
     */
    protected $_options = [];

    /**
     * @return array
     */
    public function getOptions() {
        if (property_exists($this, 'options')) {
            // This order helps to redeclare class for helpers by addOption function
            return array_merge($this->options, $this->_options);
        }

        return $this->_options;
    }

    /**
     * @param string|array $option
     * @return $this
     */
    public function addOption($option) {
        if (is_array($option)) {
            foreach ($option as $singleOption) {
                $this->addOption($singleOption);
            }
        } else {
            if (!$this->hasOption($option)) {
                $this->_options[] = $option;
            }
        }

        return $this;
    }

    /**
     * Delete exist option.
     * @param string $option
     */
    public function deleteOption($option) {
        if ($this->hasOption($option)) {
            // Deleting from both arrays

            if (property_exists($this, 'options') && (($key = array_search($option, $this->options)) !== false)) {
                unset($this->options[$key]);
            }

            if (($key = array_search($option, $this->_options)) !== false) {
                unset($this->_options[$key]);
            }
        }
    }

    /**
     * @param string $option
     * @return bool
     */
    public function hasOption($option) {
        return in_array($option, $this->getOptions());
    }

    /**
     * @return string
     */
    public function renderOptions() {
        if ($this->getOptions()) {
            return implode(' ', $this->getOptions());
        } else {
            return '';
        }
    }
}
