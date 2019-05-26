<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 13.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Columns;

use KuzyT\Halfdream\Admin\Form\FormElementContainer;
use KuzyT\Halfdream\General\Traits\HasSize;

class Column extends FormElementContainer
{
    use HasSize;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.columns.column';

    /**
     * @var array
     */
    protected $cssClasses = ['column'];

    /**
     * Column constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->addCssClass($options);
    }

    /**
     * @return string
     */
    public function renderAttributes() {
        if ($this->getSize()) {
            $this->addCssClass('is-' . $this->getSize());
        }
        return $this->renderCssClasses();
    }
}