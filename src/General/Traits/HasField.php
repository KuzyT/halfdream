<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;


trait HasField
{
    /**
     * @var string DB Field
     */
    protected $field;

    /**
     * @return string
     */
    public function getField() {
        return $this->field;
    }

    /**
     * @return array
     */
    public function getDottedFieldArray() {
        return explode('.', $this->getField());
    }

    /**
     * @param string $field
     * @return $this
     */
    public function setField($field) {
        $this->field = $field;
        return $this;
    }
}