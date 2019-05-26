<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

use KuzyT\Halfdream\General\Traits\HasType;

class CheckBox extends Field
{
    use HasType;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.checkbox';

    /**
     * CheckBox constructor.
     * @param $field
     * @param string $placeholder
     * @param string $label
     */
    public function __construct($field, string $placeholder = '', string $label = '')
    {
        parent::__construct($field, $label);
        $this->setPlaceholder($placeholder);
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['type' => $this->getType()]);
    }
}