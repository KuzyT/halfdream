<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.02.2019
 */

namespace KuzyT\Halfdream\Admin\Display;

use Illuminate\View\View;
use KuzyT\Halfdream\Admin\HalfdreamDisplayElement;
use KuzyT\Halfdream\General\Traits\HasKey;
use KuzyT\Halfdream\General\Traits\HasPaginate;

class Table extends Display
{
    /**
     * @var string
     */
    protected $view = 'halfdream::admin.display.table';

    /**
     * HasPaginate helps make an pagination.
     */
    use HasPaginate;

    /**
     * Table constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setPaginate(config('halfdream.admin.table_paginate', null));
    }

    /**
     * @return array
     */
    public function getViewData() {
        return ['columns' => $this->comprised(), 'collection' => $this->getCollection()];
    }

    /**
     * @override
     */
    public function comprised()
    {
        return array_merge(parent::comprised(), [HalfdreamDisplayElement::actions($this->getKey())]);
    }
}