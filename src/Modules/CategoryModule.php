<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 26.04.2019
 */

namespace KuzyT\Halfdream\Modules;

use KuzyT\Halfdream\Admin\Display\Display;
use KuzyT\Halfdream\Admin\Form\Form;
use KuzyT\Halfdream\Admin\HalfdreamDisplay;
use KuzyT\Halfdream\Admin\HalfdreamDisplayElement;
use KuzyT\Halfdream\Admin\HalfdreamForm;
use KuzyT\Halfdream\Admin\HalfdreamFormElement;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Models\Category;

class CategoryModule extends HalfdreamModule
{
    /**
     * @var string
     */
    protected $modelClass = Category::class;

    /**
     * Title
     */
    protected $title = 'halfdream::category.title';

    /**
     * @var bool
     */
    protected $titleIsTranslatable = true;

    /**
     * @var string
     */
    protected $icon = 'folder-open';

    /**
     * @return Display
     */
    public function display () {
        $display = HalfdreamDisplay::table();

        $display->comprise([
            HalfdreamDisplayElement::text('title', __('halfdream::category.model.title'))->setWidth('20%'),
            HalfdreamDisplayElement::text('seo_url', __('halfdream::admin.seo.seo_url')),
            HalfdreamDisplayElement::html('content', __('halfdream::category.model.content')),
        ]);

        return $display;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @return Form
     */
    public function form($model = null) {
        $form = HalfdreamForm::default();

        $form->comprise([
            HalfdreamFormElement::card(null, true)->comprise([
                HalfdreamFormElement::text('title', __('halfdream::category.model.title')),
                HalfdreamFormElement::ckeditor('content', __('halfdream::category.model.content')),
                HalfdreamFormElement::seo(with(new $this->modelClass)->getTable())
            ]),

            HalfdreamFormElement::select('parent_id', __('halfdream::category.model.parent'))->setCollectionModel($this->modelClass, 'title', 'id'),
        ]);

        return $form;
    }
}
