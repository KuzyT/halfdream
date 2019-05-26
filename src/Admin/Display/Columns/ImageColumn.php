<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 07.05.2019
 */

namespace KuzyT\Halfdream\Admin\Display\Columns;

class ImageColumn extends Column
{
    /**
     * @var string
     */
    protected $view = 'halfdream::admin.display.columns.image';

    /**
     * Get value of model field.
     * @return mixed|null
     */
    public function getDisplayedValue() {
        return image($this->getValue(), url(config('halfdream.admin.default_image')));
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['thumbnail' => thumbnail($this->getValue(), null, null, true, url(config('halfdream.admin.default_image')))]);
    }
}