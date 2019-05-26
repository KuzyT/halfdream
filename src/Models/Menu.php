<?php

namespace KuzyT\Halfdream\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KuzyT\Halfdream\Traits\Orderable;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use SoftDeletes, HasTranslations, Orderable;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $translatable = ['title', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class)->with('children', 'icon')->whereNull('parent_id')->orderBy('order');
    }
}
