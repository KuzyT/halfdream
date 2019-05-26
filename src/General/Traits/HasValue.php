<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasValue
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasValue
{
    use HasModel, HasField;

    /**
     * Get value of model field.
     * @return mixed
     */
    public function getValue() {
        // May be redeclared
        $result = $this->getModel();
        foreach ($this->getDottedFieldArray() as $field) {
            if ($result) {
                $result = $result->{$field};
            }
        }

        return $this->getValueHandler($result);
    }

    /**
     * Handler for value getter.
     * @param $value
     * @return mixed
     */
    public function getValueHandler($value) {
        // May be redeclared if needed
        return $value;
    }

    /**
     * Set value of model field.
     * @param mixed $value
     */
    public function setValue($value) {
        // May be redeclared
        $this->getModel()->{$this->getField()} = $this->prepareValue($value);
    }

    /**
     * Prepare value before set
     * @param $value
     * @return mixed
     */
    public function prepareValue($value) {
        // May be redeclared if needed
        return $value;
    }
}