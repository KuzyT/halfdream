<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Interfaces;

use KuzyT\Halfdream\General\Page\PageElement;

interface TranslatableContainer extends Translatable
{
    /**
     * @param PageElement|array $pageElement
     * @param bool $clean
     * @return $this
     */
    public function compriseTranslatable($pageElement, $clean = false);

    /**
     * @param string|null $locale
     * @return $this
     */
    public function setTranslatableLocale($locale = null);

    /**
     * @param bool $translatable
     * @return $this
     */
    public function translatable($translatable = true);

    /**
     * Used to determine if we must show translatable navigation.
     * This must be checked before container setTranslatableLocale($locale) calls.
     * Only for parent containers.
     * Doesn't work if multilocale is off in settings.
     * @return bool
     */
    public function showTranslatable();
}