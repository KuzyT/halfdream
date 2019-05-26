<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 01.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Cards;

use KuzyT\Halfdream\Admin\Form\FormElementContainer;
use KuzyT\Halfdream\General\Traits\HasLabel;

class Card extends FormElementContainer
{
    use HasLabel;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.cards.card';

    /**
     * @var array
     */
    protected $cssClasses = ['field', 'card'];

    /**
     * Card constructor.
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