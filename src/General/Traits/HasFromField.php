<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasFromField
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasFromField
{
    /**
     * @var string
     */
    protected $fromField = null;

    /**
     * @var string
     */
    protected $fromFieldTitle = null;

    /**
     * @param $field
     * @param null $title
     * @return $this
     */
    public function setFromField($field, $title = null) {
        $this->fromField = $field;
        $this->fromFieldTitle = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromField() {
        return $this->fromField;
    }

    /**
     * @return string
     */
    public function getFromFieldTitle() {
        return $this->fromFieldTitle;
    }
}