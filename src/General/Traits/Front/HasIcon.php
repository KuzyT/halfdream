<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 22.05.2019
 */

namespace KuzyT\Halfdream\General\Traits\Front;

use KuzyT\Halfdream\Models\Icon;

/**
 * Trait HasIcon
 * @package KuzyT\Halfdream\General\Traits\Front
 */
trait HasIcon
{
    protected function getIconModelClass() {
        return Icon::class;
    }

    protected function getIconField() {
        return 'icon_id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function icon()
    {
        return $this->belongsTo($this->getIconModelClass(), $this->getIconField());
    }
}