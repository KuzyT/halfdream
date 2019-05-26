<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form;

use KuzyT\Halfdream\Admin\HalfdreamFormElement;

class DefaultForm extends Form
{
    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.default';

    /**
     * @return array
     */
    public function getViewData() {
        return ['elements' => $this->comprised(), 'model' => $this->getModel(), 'key' => $this->getKey(), 'id' => $this->getModel() ? $this->getModel()->id : null];
    }

    /**
     * @override
     */
    public function comprised()
    {
        return [HalfdreamFormElement::card()->comprise(array_merge(parent::comprised(), [HalfdreamFormElement::button($this->getModel() ? __('halfdream::admin.edit.button') : __('halfdream::admin.create.button'))]))];
    }
}