<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait IsTranslatable.
 * Base trait for all Form Elements.
 * @package KuzyT\Halfdream\General\Traits
 */
trait IsTranslatable
{
    /**
     * @var bool
     */
    protected $isTranslatable = false;

    /**
     * @var string|null
     */
    protected $translatableLocale = null;

    /**
     * @param string|null $locale
     * @return $this
     */
    public function setTranslatableLocale($locale = null) {
        $this->translatableLocale = $locale;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTranslatableLocale() {
        return $this->translatableLocale;
    }

    /**
     * @param bool $enable
     * @return $this
     */
    public function translatable($enable = true) {
        $this->isTranslatable = $enable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTranslatable() {
        return $this->isTranslatable;
    }

}