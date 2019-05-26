<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasModel
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasModel
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     */
    public function setModel(Model $model) {
        $this->model = $model;
        return $this;
    }
}