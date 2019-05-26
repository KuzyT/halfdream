<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 06.03.2019
 */

namespace KuzyT\Halfdream\Admin\Display\Columns;

use KuzyT\Halfdream\General\Traits\HasKey;

class ActionsColumn extends Column
{
    use HasKey;

    /**
     * @var string Hardcoding width here for now
     */
    protected $width = '100px';

    /**
     * @override
     */
    public function __construct($key, string $label = '')
    {
        $this->setKey($key);
        $this->setLabel($label);
    }

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.display.columns.actions';

    /**
     * Special for Delete Action
     * @return array
     */
    public function getComponentTranslation() {
        return [
            'delete' => [
                'title' => __('halfdream::admin.delete.title'),
                'message' => __('halfdream::admin.delete.message', ['module' => __('halfdream::admin.item')]),
                'confirm' => __('halfdream::admin.delete.confirm'),
                'cancel' => __('halfdream::admin.delete.cancel'),
            ]
        ];
    }

    /**
     * @return array
     */
    public function getViewData() {
        return ['id' => $this->getModel()->id ?: null, 'key' => $this->getKey(), 'lang' => $this->getComponentTranslation()];
    }
}