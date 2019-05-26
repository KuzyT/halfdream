<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 24.04.2019
 */

namespace KuzyT\Halfdream\General\Traits\Front;

/**
 * Trait HasAvatar
 * @package KuzyT\Halfdream\General\Traits
 * @property string $avatar Field must be in model.
 * @property string $defaultAvatar Can be in model.
 */
trait HasAvatar
{
    /**
     * @return string|null
     */
    public function getDefaultAvatar() {
        if (property_exists($this, 'defaultAvatar')) {
            return $this->defaultAvatar;
        }

        return config('halfdream.front.default_avatar');
    }

    /**
     * @return null|string
     */
    public function getAvatar() {
        if (property_exists($this, 'avatar') && $this->avatar) {
            return $this->avatar;
        }

        if ($defaultAvatar = $this->getDefaultAvatar()) {
            return $defaultAvatar;
        }

        return null;
    }
}
