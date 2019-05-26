<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasModelContainer
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasModelContainer
{
    use HasModel;

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model) {
        $this->model = $model;

        foreach ($this->pageElements as $element) {
            if (method_exists($element, 'setModel')) {
                $element->setModel($model);
            }
        }

        return $this;
    }
}