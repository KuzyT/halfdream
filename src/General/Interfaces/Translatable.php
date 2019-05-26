<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Interfaces;

interface Translatable
{
    /**
     * @param string|null $locale
     * @return $this
     */
    public function setTranslatableLocale($locale = null);

    /**
     * @return null|string
     */
    public function getTranslatableLocale();

    /**
     * @param bool $enable
     * @return $this
     */
    public function translatable($enable = true);

    /**
     * @return bool
     */
    public function isTranslatable();
}