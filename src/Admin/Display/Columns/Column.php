<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.02.2019
 */

namespace KuzyT\Halfdream\Admin\Display\Columns;

use KuzyT\Halfdream\Admin\Display\DisplayElement;
use KuzyT\Halfdream\General\Traits\HasCssClasses;
use KuzyT\Halfdream\General\Traits\HasField;
use KuzyT\Halfdream\General\Traits\HasModel;
use KuzyT\Halfdream\General\Traits\HasStyle;
use KuzyT\Halfdream\General\Traits\HasLabel;
use KuzyT\Halfdream\General\Traits\HasValue;
use KuzyT\Halfdream\General\Traits\HasWidth;

abstract class Column extends DisplayElement
{
    use HasStyle, HasWidth, HasLabel, HasValue, HasCssClasses;

    /**
     * @var string
     */
    protected $view;

    /**
     * Column constructor.
     * @param $field
     * @param $label
     */
    public function __construct($field, $label = '')
    {
        $this->setField($field);
        $this->setLabel($label);
    }

    /**
     * Get value of model field.
     * @return mixed|null
     */
    public function getDisplayedValue() {
        /*
         * You may redeclare this function - for use MaxSize and other things.
         */
        return $this->getValue();
    }

    /**
     * @return array
     */
    public function getViewData() {
        return ['value' => $this->getDisplayedValue()];
    }

    /**
     * @return string
     */
    public function renderTitleAttributes() {
        return $this->renderWidth();
    }

    /**
     * @return string
     */
    public function renderAttributes() {
        return $this->renderTitleAttributes() . $this->renderCssClasses() . $this->renderStyle();
    }
}