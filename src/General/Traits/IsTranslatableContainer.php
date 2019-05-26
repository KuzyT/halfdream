<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 26.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use KuzyT\Halfdream\General\Page\PageElement;

/**
 * Trait IsTranslatableContainer.
 * Trait for container form elements.
 * @package KuzyT\Halfdream\General\Traits
 */
trait IsTranslatableContainer
{
    use IsTranslatable, IsComprisable;

    /**
     * @param PageElement|array $pageElement
     * @param bool $clean
     * @return $this
     */
    public function compriseTranslatable($pageElement, $clean = false) {
        if ($clean) {
            $this->pageElements = [];
        }

        if (is_array($pageElement)) {
            foreach ($pageElement as $element) {
                $this->compriseTranslatable($element);
            }
        } else {
            if ($this->isTranslatable() && method_exists($pageElement, 'translatable')) {
                $pageElement->translatable();
            }
            $this->pageElements[] = $pageElement;
        }

        return $this;
    }

    /**
     * @param string|null $locale
     * @return $this
     */
    public function setTranslatableLocale($locale = null) {
        $this->translatableLocale = $locale;

        foreach ($this->pageElements as $element) {
            if (method_exists($element, 'setTranslatableLocale')) {
                $element->setTranslatableLocale($locale);
            }
        }

        return $this;
    }

    /**
     * @param bool $translatable
     * @return $this
     */
    public function translatable($translatable = true) {
        $this->isTranslatable = $translatable;

        foreach ($this->pageElements as $element) {
            if (method_exists($element, 'translatable')) {
                $element->translatable($translatable);
            }
        }

        return $this;
    }

    /**
     * Used to determine if we must show translatable navigation.
     * This must be checked before container setTranslatableLocale($locale) calls.
     * Only for parent containers.
     * Doesn't work if multilocale is off in settings.
     * @return bool
     */
    public function showTranslatable() {
        return \Halfdream::multiLocale() && $this->isTranslatable() && !$this->getTranslatableLocale();
    }
}