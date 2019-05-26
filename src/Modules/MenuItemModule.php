<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.05.2019
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
use KuzyT\Halfdream\Models\Icon;
use KuzyT\Halfdream\Models\Menu;
use KuzyT\Halfdream\Models\MenuItem;

class MenuItemModule extends HalfdreamModule
{
    /**
     * @var string
     */
    protected $modelClass = MenuItem::class;

    /**
     * Title
     */
    protected $title = 'halfdream::menu_item.title';

    /**
     * @var bool
     */
    protected $titleIsTranslatable = true;

    /**
     * @var string
     */
    protected $icon = 'bars';

    /**
     * @return Display
     */
    public function display () {
        $display = HalfdreamDisplay::table();

        $display->comprise([
            HalfdreamDisplayElement::icon('icon.adminIcon', __('halfdream::menu_item.model.icon'))->setWidth('64px'),
            HalfdreamDisplayElement::text('adminTitle', __('halfdream::menu_item.model.title')),
            HalfdreamDisplayElement::text('link', __('halfdream::menu_item.model.url')),
            HalfdreamDisplayElement::boolean('visible', __('halfdream::menu_item.model.visible'))->setWidth('30px'),
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
            HalfdreamFormElement::columns()
                ->addColumn([
                    HalfdreamFormElement::select('menu_id', __('halfdream::menu_item.model.menu'))->setCollectionModel(Menu::class, 'title', 'id')->required(),
                    HalfdreamFormElement::select('icon_id', __('halfdream::menu_item.model.icon'))->setCollectionModel(Icon::class, 'adminTitle', 'id'),
                    HalfdreamFormElement::text('color', __('halfdream::menu_item.model.color'))
                ], 6)
                ->addColumn([
                    HalfdreamFormElement::select('target', __('halfdream::menu_item.model.target'))->setCollection(with(new $this->modelClass)->getTargetsValues())->setDefaultValue(with(new $this->modelClass)->getDefaultTarget())->required(),
                    HalfdreamFormElement::select('parent_id', __('halfdream::menu_item.model.parent'))->setCollectionModel($this->modelClass, 'title', 'id'),
                    HalfdreamFormElement::text('class', __('halfdream::menu_item.model.class'))
                ], 6),
            HalfdreamFormElement::card(null, true)->comprise([
                HalfdreamFormElement::text('title', __('halfdream::menu_item.model.title')),
                HalfdreamFormElement::checkbox('visible', __('halfdream::menu_item.model.visible'))->setDefaultValue(true),
                HalfdreamFormElement::card(__('halfdream::menu_item.form.url'))->comprise([
                    HalfdreamFormElement::text('url', __('halfdream::menu_item.model.url')),
                ]),
                HalfdreamFormElement::card(__('halfdream::menu_item.form.route'))->comprise([
                    HalfdreamFormElement::text('route', __('halfdream::menu_item.model.route')),
                    HalfdreamFormElement::text('parameters', __('halfdream::menu_item.model.parameters')),
                ]),
            ]),

        ]);

        return $form;
    }
}
