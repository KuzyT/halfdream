<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.05.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Modules;

use KuzyT\Halfdream\Admin\Form\FormElementContainer;
use KuzyT\Halfdream\General\Traits\HasLabel;
use KuzyT\Halfdream\General\Traits\HasModule;

class Display extends FormElementContainer
{
    use HasLabel, HasModule;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.modules.display';

    /**
     * @var array
     */
    protected $cssClasses = ['field', 'card'];

    /**
     * Display constructor.
     * @param $module
     * @param array $options
     * @param string $label
     */
    public function __construct($module, $options = [], $label = '')
    {
        // todo - change for using with breadcrumbs
        session()->put('back', url()->current());
        $this->setModule(new $module, $options);
        $this->setLabel($label);
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['label' => $this->getLabel() ?: $this->getModuleTitle(), 'display' => $this->getModuleDisplay(), 'options' => $this->getModuleOptions()]);
    }
}
