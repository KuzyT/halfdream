<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.02.2019
 */

namespace KuzyT\Halfdream\Modules;

use App\User;
use KuzyT\Halfdream\Admin\Display\Display;
use KuzyT\Halfdream\Admin\Form\Form;
use KuzyT\Halfdream\Admin\HalfdreamDisplay;
use KuzyT\Halfdream\Admin\HalfdreamDisplayElement;
use KuzyT\Halfdream\Admin\HalfdreamForm;
use KuzyT\Halfdream\Admin\HalfdreamFormElement;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Models\Category;
use KuzyT\Halfdream\Models\Post;

class PostModule extends HalfdreamModule
{
    /**
     * @var string
     */
    protected $modelClass = Post::class;

    /**
     * Title
     */
    protected $title = 'halfdream::post.title';

    /**
     * @var bool
     */
    protected $titleIsTranslatable = true;

    /**
     * @var string
     */
    protected $icon = 'book';

    /**
     * @return Display
     */
    public function display () {
        $display = HalfdreamDisplay::table();

        $display->comprise([
            HalfdreamDisplayElement::image('image', __('halfdream::post.model.image'))->setWidth('64px'),
            HalfdreamDisplayElement::text('title', __('halfdream::post.model.title'))->setWidth('20%'),
            HalfdreamDisplayElement::html('content', __('halfdream::post.model.content')),
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
            HalfdreamFormElement::select('user_id', __('halfdream::post.model.user'))->setCollectionModel(User::class, 'name', 'id')->setDefaultValue(\Auth::id()),

            HalfdreamFormElement::card(null, true)->comprise([
                HalfdreamFormElement::columns()
                    ->addColumn([
                        HalfdreamFormElement::uploadimage('image', __('halfdream::post.model.image'), with(new $this->modelClass)->getSeoUrlField(), 'title'),
                    ], 5)
                    ->addColumn([
                        HalfdreamFormElement::text('title', __('halfdream::post.model.title')),
                        HalfdreamFormElement::select('status', __('halfdream::post.model.status'))->setCollection(with(new $this->modelClass)->getStatusesValues())->setDefaultValue(with(new $this->modelClass)->getDefaultStatus())->required(),
                        HalfdreamFormElement::datetime('published_at', __('halfdream::post.model.published_at'))->setDefaultValue(\Carbon\Carbon::now()),
                    ], 7),
                HalfdreamFormElement::ckeditor('content', __('halfdream::post.model.content')),
                HalfdreamFormElement::uploadimages('gallery', __('halfdream::post.model.gallery'), with(new $this->modelClass)->getSeoUrlField(), 'title'),
                HalfdreamFormElement::seo(with(new $this->modelClass)->getTable())
            ]),

            HalfdreamFormElement::select('category_id', __('halfdream::post.model.category'))->setCollectionModel(Category::class, 'title', 'id'),
        ]);

        return $form;
    }
}
