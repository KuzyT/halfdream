<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form;

use KuzyT\Halfdream\General\Interfaces\Comprisable;
use KuzyT\Halfdream\General\Interfaces\TranslatableContainer;
use KuzyT\Halfdream\General\Traits\HasModelContainer;
use KuzyT\Halfdream\General\Traits\IsTranslatableContainer;

class FormElementContainer extends FormElement implements Comprisable, TranslatableContainer
{
    // isTranslatableContainer uses isComprisable
    use IsTranslatableContainer, HasModelContainer;

    /**
     * @param FormElement|array $pageElement
     * @param bool $clean
     * @return $this
     */
    public function comprise($pageElement, $clean = false) {
        return $this->compriseTranslatable($pageElement, $clean);
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['container' => $this, 'elements' => $this->comprised(), 'model' => $this->getModel()]);
    }
}