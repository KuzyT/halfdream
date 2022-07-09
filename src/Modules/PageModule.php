<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 06.05.2019
 */

namespace KuzyT\Halfdream\Modules;

use App\Models\User;
use KuzyT\Halfdream\Admin\Display\Display;
use KuzyT\Halfdream\Admin\Form\Form;
use KuzyT\Halfdream\Admin\HalfdreamDisplay;
use KuzyT\Halfdream\Admin\HalfdreamDisplayElement;
use KuzyT\Halfdream\Admin\HalfdreamForm;
use KuzyT\Halfdream\Admin\HalfdreamFormElement;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Models\Category;
use KuzyT\Halfdream\Models\Page;

class PageModule extends HalfdreamModule
{
    /**
     * @var string
     */
    protected $modelClass = Page::class;

    /**
     * Title
     */
    protected $title = 'halfdream::page.title';

    /**
     * @var bool
     */
    protected $titleIsTranslatable = true;

    /**
     * @var string
     */
    protected $icon = 'file';

    /**
     * @return Display
     */
    public function display () {
        $display = HalfdreamDisplay::table();

        $display->comprise([
            HalfdreamDisplayElement::image('image', __('halfdream::post.model.image'))->setWidth('64px'),
            HalfdreamDisplayElement::text('title', __('halfdream::page.model.title'))->setWidth('20%'),
            HalfdreamDisplayElement::text('seo_url', __('halfdream::admin.seo.seo_url'))->setWidth('20%'),
            HalfdreamDisplayElement::html('content', __('halfdream::page.model.content')),
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
                HalfdreamFormElement::columns()
                    ->addColumn([
                        HalfdreamFormElement::uploadimage('image', __('halfdream::page.model.image'), with(new $this->modelClass)->getSeoUrlField(), 'title'),
                    ], 5)
                    ->addColumn([
                        HalfdreamFormElement::text('title', __('halfdream::page.model.title')),
                        HalfdreamFormElement::select('status', __('halfdream::page.model.status'))->setCollection(with(new $this->modelClass)->getStatusesValues())->setDefaultValue(with(new $this->modelClass)->getDefaultStatus())->required(),
                    ], 7),
                HalfdreamFormElement::ckeditor('content', __('halfdream::page.model.content')),
                HalfdreamFormElement::uploadimages('gallery', __('halfdream::page.model.gallery'), with(new $this->modelClass)->getSeoUrlField(), 'title'),
                HalfdreamFormElement::seo(with(new $this->modelClass)->getTable())
            ]),

            HalfdreamFormElement::select('parent_id', __('halfdream::page.model.parent'))->setCollectionModel($this->modelClass, 'title', 'id'),
        ]);

        return $form;
    }
}
