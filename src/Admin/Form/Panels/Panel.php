<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 01.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Panels;

use KuzyT\Halfdream\Admin\Form\FormElementContainer;
use KuzyT\Halfdream\General\Traits\HasLabel;

class Panel extends FormElementContainer
{
    use HasLabel;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.panels.panel';

    /**
     * @var array
     */
    protected $cssClasses = ['field', 'panel'];

    /**
     * Panel constructor.
     * @param string $label
     * @param bool $translatable
     */
    public function __construct($label = '', $translatable = false)
    {
        $this->setLabel($label);
        $this->translatable($translatable);
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['label' => $this->getLabel()]);
    }
}