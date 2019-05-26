<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 01.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

use KuzyT\Halfdream\Admin\Form\FormElement;
use KuzyT\Halfdream\General\Interfaces\TranslatableElement;
use KuzyT\Halfdream\General\Interfaces\Validatable;
use KuzyT\Halfdream\General\Traits\HasDefaultValue;
use KuzyT\Halfdream\General\Traits\HasIcon;
use KuzyT\Halfdream\General\Traits\HasLabel;
use KuzyT\Halfdream\General\Traits\HasPlaceholder;
use KuzyT\Halfdream\General\Traits\HasRequired;
use KuzyT\Halfdream\General\Traits\HasSize;
use KuzyT\Halfdream\General\Traits\HasUnique;
use KuzyT\Halfdream\General\Traits\IsTranslatableElement;

abstract class Field extends FormElement implements Validatable, TranslatableElement
{
    // HasRequired uses HasOptions
    // IsTranslatableElement uses HasValue
    use HasLabel, HasPlaceholder, HasIcon, HasSize, HasDefaultValue, IsTranslatableElement, HasRequired, HasUnique;

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
     * @return mixed
     */
    public function getDisplayedValue() {
        return \Halfdream::hasOldInput($this->getTranslatableDotField())
            ? old($this->getTranslatableDotField())
            // Checking for get parameters too
            : request()->get($this->getTranslatableDotField(), (
                $this->getModel()
                    ? $this->getTranslatableValue()
                    : $this->getDefaultValue()
            ));
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $this->addRuleRequired($rules);
        $this->addRuleUnique($rules);
        return $rules;
    }

    /**
     * @return array
     */
    public function validatorMessages()
    {
        $messages = [];
        $this->addValidatorMessageUnique($messages);
        return $messages;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['value' => $this->getDisplayedValue(), 'label' => $this->getLabel(), 'placeholder' => $this->getPlaceholder(), 'size' => $this->getSize(), 'name' => $this->getTranslatableDisplayField(), 'nameDot' => $this->getTranslatableDotField(), 'icon' => $this->getIcon(), 'options' => $this->renderOptions()]);
    }
}
