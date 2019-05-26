<?php

namespace KuzyT\Halfdream\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KuzyT\Halfdream\General\Traits\Front\HasIcon;
use KuzyT\Halfdream\Traits\Orderable;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use SoftDeletes, HasTranslations, Orderable, HasIcon;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $translatable = ['title', 'url', 'visible', 'route', 'parameters'];

    /**
     * Targets.
     */
    const TARGET_SELF = '_self';
    const TARGET_BLANK = '_blank';

    /**
     * @var array
     */
    public static $targets = [self::TARGET_SELF, self::TARGET_BLANK];

    public static function getTargets()
    {
        return static::$targets;
    }

    /**
     * @return array
     */
    public static function getTargetsValues()
    {
        return [
            self::TARGET_SELF => __('halfdream::menu_item.target.'.self::TARGET_SELF),
            self::TARGET_BLANK => __('halfdream::menu_item.target.'.self::TARGET_BLANK),
        ];
    }

    /**
     * @return string
     */
    public static function getDefaultTarget() {
        return self::TARGET_SELF;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query) {
        return $query->where('visible', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->items()->visible();
    }

    /**
     * @deprecated when it will be a Tree Display, it will be changed
     * @return mixed|string
     */
    public function getAdminTitleAttribute() {
        if ($this->parent) {
            return $this->parent->adminTitle . ' -> ' . $this->title;
        } else {
            return $this->title;
        }
    }

    public function getRouteParametersAttribute() {
        return $this->parameters ? json_decode($this->parameters) : [];
    }

    public function getLinkAttribute() {
        if ($this->route) {
            return __route($this->route, $this->routeParameters);
        } else {
            return url($this->url);
        }
    }
}
