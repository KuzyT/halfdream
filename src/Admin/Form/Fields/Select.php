<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 15.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

use KuzyT\Halfdream\General\Traits\HasCollection;
use KuzyT\Halfdream\General\Traits\HasModelClass;

class Select extends Field
{
    use HasCollection, HasModelClass;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.select';

    /**
     * Select constructor.
     * @param $field
     * @param string $label
     * @param bool $expanded
     */
    public function __construct($field, string $label = '', $expanded = true)
    {
        parent::__construct($field, $label);
        if ($expanded) {
            $this->setExpanded();
        }
    }

    /**
     * @return $this
     */
    public function setExpanded() {
        $this->addOption('expanded');
        return $this;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['collection' => $this->getCollection()]);
    }
}