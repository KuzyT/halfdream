<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 22.05.2019
 */

namespace KuzyT\Halfdream\Modules;

use KuzyT\Halfdream\Admin\Display\Display;
use KuzyT\Halfdream\Admin\Form\Form;
use KuzyT\Halfdream\Admin\HalfdreamDisplay;
use KuzyT\Halfdream\Admin\HalfdreamDisplayElement;
use KuzyT\Halfdream\Admin\HalfdreamForm;
use KuzyT\Halfdream\Admin\HalfdreamFormElement;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Models\Icon;

class IconModule extends HalfdreamModule
{
    /**
     * @var string
     */
    protected $modelClass = Icon::class;

    /**
     * Title
     */
    protected $title = 'halfdream::icon.title';

    /**
     * @var bool
     */
    protected $titleIsTranslatable = true;

    /**
     * @var string
     */
    protected $icon = 'fab.fort-awesome';

    /**
     * @return Display
     */
    public function display () {
        $display = HalfdreamDisplay::table();

        $display->comprise([
            HalfdreamDisplayElement::icon('adminIcon', __('halfdream::icon.model.icon'))->setWidth('64px'),
            HalfdreamDisplayElement::text('title', __('halfdream::icon.model.title')),
            HalfdreamDisplayElement::text('adminType', __('halfdream::icon.model.type'))->setWidth('20%'),
            HalfdreamDisplayElement::text('key', __('halfdream::icon.model.key'))->setWidth('20%'),
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
                    HalfdreamFormElement::text('icon', __('halfdream::icon.model.icon')),
                ], 6)
                ->addColumn([
                    HalfdreamFormElement::select('type', __('halfdream::icon.model.type'))->setCollection(with(new $this->modelClass)->getTypesValues())->setDefaultValue(with(new $this->modelClass)->getDefaultType())->required(),
                ], 6),
            HalfdreamFormElement::card(null, true)->comprise([
                HalfdreamFormElement::text('title', __('halfdream::icon.model.title')),
                HalfdreamFormElement::textarea('svg', __('halfdream::icon.model.svg')),
                HalfdreamFormElement::uploadimage('image', __('halfdream::icon.model.image'), 'icon', __('halfdream::icon.model.icon')),
            ]),
        ]);

        return $form;
    }
}
