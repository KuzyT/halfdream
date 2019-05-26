<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 13.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Columns;

use KuzyT\Halfdream\Admin\Form\FormElement;
use KuzyT\Halfdream\Admin\Form\FormElementContainer;

class Columns extends FormElementContainer
{
    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.columns.columns';

    /**
     * @var array
     */
    protected $cssClasses = ['columns'];

    /**
     * Columns constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->addCssClass($options);
    }

    /**
     * @param FormElement[] $elements
     * @param mixed $size
     * @param array $options
     * @return $this
     */
    public function addColumn($elements, $size = null, $options = []) {
        $column = new Column($options);
        if ($size) {
            $column->setSize($size);
        }
        $column->comprise($elements);

        $this->comprise($column);

        return $this;
    }
}