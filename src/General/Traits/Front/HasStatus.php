<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 06.05.2019
 */

namespace KuzyT\Halfdream\General\Traits\Front;

/**
 * Trait HasStatus
 * @package KuzyT\Halfdream\General\Traits\Front
 */
trait HasStatus
{
    /**
     * @return string
     */
    public static function getStatusField() {
        return 'status';
    }

    /**
     * @return array
     */
    public static function getStatuses() {
        return ['active', 'inactive', 'draft'];
    }

    /**
     * @return array
     */
    public static function getActiveStatuses() {
        return ['active'];
    }

    /**
     * @return array
     */
    public static function getStatusesValues()
    {
        return [
            'active' => __('halfdream::admin.status.active'),
            'draft' => __('halfdream::admin.status.draft'),
            'inactive' => __('halfdream::admin.status.inactive'),
        ];
    }

    /**
     * @return string
     */
    public static function getDefaultStatus() {
        return 'active';
    }

    /**
     * @param $query
     * @param null $locale
     * @return mixed
     */
    public function scopeActive($query, $locale = null)
    {
        if (!empty($this->translatable) && in_array(static::getStatusField(), $this->translatable)) {
            // todo - do something for config('halfdream.db_json') is false, for mysql 5.6
            return $query->whereIn('status->' . ($locale ?: locale()), static::getActiveStatuses());
        } else {
            return $query->whereIn('status', static::getActiveStatuses());
        }
    }
}