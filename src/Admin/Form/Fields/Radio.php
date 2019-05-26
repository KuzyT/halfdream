<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 15.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

use KuzyT\Halfdream\General\Traits\HasCollection;
use KuzyT\Halfdream\General\Traits\HasModelClass;
use KuzyT\Halfdream\General\Traits\HasType;

class Radio extends Field
{
    use HasCollection, HasModelClass, HasType;

    /**
     * @var boolean
     */
    protected $isHorizontal;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.radio';

    /**
     * Select constructor.
     * @param $field
     * @param string $label
     * @param bool $isHorizontal
     */
    public function __construct($field, string $label = '', $isHorizontal = true)
    {
        parent::__construct($field, $label);
        if ($isHorizontal) {
            $this->setHorizontal($isHorizontal);
        }
    }

    /**
     * @param bool $isHorizontal
     * @return $this
     */
    public function setHorizontal($isHorizontal = true) {
        $this->isHorizontal = $isHorizontal;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['type' => $this->getType(), 'collection' => $this->getCollection(), 'horizontal' => $this->isHorizontal]);
    }
}