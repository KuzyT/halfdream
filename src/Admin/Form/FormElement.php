<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form;

use KuzyT\Halfdream\General\Interfaces\Translatable;
use KuzyT\Halfdream\General\Page\PageElement;
use KuzyT\Halfdream\General\Traits\HasCssClasses;
use KuzyT\Halfdream\General\Traits\HasModel;
use KuzyT\Halfdream\General\Traits\IsTranslatable;

class FormElement extends PageElement implements Translatable
{
    use HasCssClasses, HasModel, IsTranslatable;

    /**
     * @return string
     */
    public function renderAttributes() {
        return $this->renderCssClasses();
    }

    /**
     * @return array
     */
    public function getViewData() {
        return ['attributes' => $this->renderAttributes()];
    }
}