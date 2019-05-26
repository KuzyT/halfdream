<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasRequired.
 * Works with Options.
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasRequired
{
    use HasOptions;

    public static $constRequired = 'required';

    /**
     * @param bool $enable
     * @return $this
     */
    public function required($enable = true) {
        if ($enable) {
            $this->addOption(static::$constRequired);
        } else {
            $this->deleteOption(static::$constRequired);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired() {
        return $this->hasOption(static::$constRequired);
    }

    /**
     * @param &array $rules
     */
    public function addRuleRequired(&$rules)
    {
        if ($this->isRequired()) {
            $rules[] = static::$constRequired; // validate const equal to form const
        }
    }
}