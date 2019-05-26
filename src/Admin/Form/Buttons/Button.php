<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 06.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Buttons;

use KuzyT\Halfdream\Admin\Form\FormElement;
use KuzyT\Halfdream\General\Traits\HasStyle;
use KuzyT\Halfdream\General\Traits\HasLabel;

class Button extends FormElement
{
    use HasLabel, HasStyle;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.buttons.button';

    /**
     * Button constructor.
     * @param string $label
     */
    public function __construct($label = '')
    {
        $this->setLabel($label);
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['label' => $this->getLabel()]);
    }
}