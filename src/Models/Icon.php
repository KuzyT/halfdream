<?php

namespace KuzyT\Halfdream\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Icon extends Model
{
    use SoftDeletes, HasTranslations;

    public $timestamps = false;

    public $translatable = ['title', 'svg', 'image'];

    const TYPE_FAS = 'fas';
    const TYPE_FAR = 'far';
    const TYPE_FAL = 'fal';
    const TYPE_FAB = 'fab';
    const TYPE_SVG = 'svg';
    const TYPE_IMAGE = 'image';

    /**
     * List of icon types.
     *
     * @var array
     */
    public static $iconTypes = [self::TYPE_FAS, self::TYPE_FAR, self::TYPE_FAL, self::TYPE_FAB, self::TYPE_SVG, self::TYPE_IMAGE];

    /**
     * List of Font Awesome icon types.
     *
     * @var array
     */
    public static $iconFATypes = [self::TYPE_FAS, self::TYPE_FAR, self::TYPE_FAL, self::TYPE_FAB];

    /**
     * @return array
     */
    public static function getTypes()
    {
        return static::$iconTypes;
    }

    /**
     * @return array
     */
    public static function getFATypes()
    {
        return static::$iconFATypes;
    }

    /**
     * @return array
     */
    public static function getTypesValues()
    {
        // For Font Awesome - FAL is only for PRO license, but keep it here
        // (maybe some new icons will be free in future, like far?)
        return [
            self::TYPE_FAS => __('halfdream::icon.type.'.self::TYPE_FAS),
            self::TYPE_FAR => __('halfdream::icon.type.'.self::TYPE_FAR),
            self::TYPE_FAL => __('halfdream::icon.type.'.self::TYPE_FAL),
            self::TYPE_FAB => __('halfdream::icon.type.'.self::TYPE_FAB),
            self::TYPE_SVG => __('halfdream::icon.type.'.self::TYPE_SVG),
            self::TYPE_IMAGE => __('halfdream::icon.type.'.self::TYPE_IMAGE)

        ];
    }

    /**
     * @return string
     */
    public static function getDefaultType() {
        return self::TYPE_FAS;
    }

    /**
     * @return mixed
     */
    public function getKeyAttribute() {
        return $this->type . '.' . $this->icon;
    }

    /**
     * @return mixed
     */
    public function getAdminTypeAttribute() {
        return self::getTypesValues()[$this->type];
    }

    /**
     * @param array $options Additional options
     * * size => For FA as 'fa-<$size>', for other - will be added additional class with that name
     * @return string
     * @throws \Throwable
     */
    public function render($options = []) {
        $view = 'halfdream::general.icons.';
        $options = array_merge([
            'size' => 'lg'
        ],$options);
        switch ($this->type) {
            case self::TYPE_FAS :
            case self::TYPE_FAR :
            case self::TYPE_FAL :
            case self::TYPE_FAB :
                $view .= 'fa';
                $options['value'] = \Halfdream::prepareFAIcon($this->key);
                break;
            case self::TYPE_SVG :
                $view .= 'svg';
                $options['value'] = $this->svg;
                break;
            case self::TYPE_IMAGE :
                $view .= 'image';
                $options['value'] = image($this->image);
                break;
            default : return '';
        }

        return view($view, $options)->render();
    }

    /**
     * @return string
     */
    public function getAdminIconAttribute() {
        return $this->render();
    }

    /**
     * @return mixed
     */
    public function getAdminTitleAttribute() {
        return $this->title ?: $this->key;
    }

    /**
     * @return string
     */
    public function getFaLibraryTypeAttribute() {
        return config(
            'halfdream.modules.icons.library.'
                . (config('halfdream.modules.icons.pro') ? 'pro' : 'free')
                . '.' . $this->type,
                null
            );
    }

    /**
     * @return string
     */
    public function getFaCamelKeyAttribute() {
        return 'fa' . ucfirst(camel_case($this->icon));
    }

    /**
     * @return mixed|string
     */
    public function getFaTypeCamelKeyAttribute() {
        switch ($this->type) {
            case self::TYPE_FAS : return $this->faCamelKey;
            default : return $this->type . ucfirst($this->faCamelKey);
        }
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function __toString()
    {
        return $this->render();
    }
}
