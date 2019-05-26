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
use KuzyT\Halfdream\Models\Menu;
use KuzyT\Halfdream\Models\MenuItem;

class MenuModule extends HalfdreamModule
{
    /**
     * @var string
     */
    protected $modelClass = Menu::class;

    /**
     * Title
     */
    protected $title = 'halfdream::menu.title';

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
            HalfdreamDisplayElement::text('title', __('halfdream::menu.model.title')),
            HalfdreamDisplayElement::text('key', __('halfdream::menu.model.key'))->setWidth('20%'),
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
            HalfdreamFormElement::text('key', __('halfdream::menu.model.key'))->unique(with(new $this->modelClass)->getTable()),
            HalfdreamFormElement::card(null, true)->comprise([
                HalfdreamFormElement::text('title', __('halfdream::menu.model.title'))
            ]),
            HalfdreamFormElement::text('order', __('halfdream::menu.model.order'))->setDefaultValue(1),
        ]);

        if ($model) {
            $form->comprise(HalfdreamFormElement::module(\Halfdream::loadModuleByModelClass(MenuItem::class), [
                'paginate' => false,
                'queryPrepare' => function($query) use ($model) {
                    return $query->orderBy('order', 'asc')->where('menu_id', $model->id);
                },
                'parameters' => ['menu_id' => $model->id],
            ]));
        }

        return $form;
    }
}
