<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 13.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

use KuzyT\Halfdream\General\Traits\HasMaxSize;
use KuzyT\Halfdream\General\Traits\HasMinSize;
use KuzyT\Halfdream\General\Traits\HasType;

abstract class Input extends Field
{
    use HasMaxSize, HasMinSize, HasType;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.input';

    /**
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $this->addRuleMaxSize($rules);
        $this->addRuleMinSize($rules);
        return $rules;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['maxSize' => $this->getMaxSize(), 'minSize' => $this->getMinSize(), 'type' => $this->getType()]);
    }
}