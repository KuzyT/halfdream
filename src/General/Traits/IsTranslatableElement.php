<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 26.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use KuzyT\Halfdream\General\Interfaces\Validatable;

/**
 * Trait IsTranslatableElement
 * Trait for form elements with value.
 * @package KuzyT\Halfdream\General\Traits
 */
trait IsTranslatableElement
{
    use IsTranslatable, HasValue;

    /**
     * If element is translatable, then - there will be N fields of it. So
     * we have a method to get all the fields for working whith it.
     * Well, we must have a method to get Current translatable field and value.
     */

    /**
     * @return string
     */
    public function getTranslatableValue() {
        if ($this->isTranslatable() &&
            ($locale = $this->getTranslatableLocale()) &&
            method_exists($model = $this->getModel(), 'getTranslation'))
        {
            return $this->getTranslatableValueHandler($model->getTranslation($this->getField(), $locale));
        }

        return $this->getValue();
    }

    /**
     * Handler for translatable value getter.
     * @param $value
     * @param string|null $locale
     * @return mixed
     */
    public function getTranslatableValueHandler($value, $locale = null) {
        // May be redeclared if needed
        return $this->getValueHandler($value);
    }

    /**
     * @param string $localePrefix
     * @param string $localeSuffix
     * @return string
     */
    public function getTranslatableField($localePrefix = '', $localeSuffix = '') {
        if ($this->isTranslatable() && $locale = $this->getTranslatableLocale()) {
            return $this->getField() . $localePrefix . $locale . $localeSuffix;
        }

        return $this->getField();
    }

    /**
     * @return string
     */
    public function getTranslatableDisplayField() {
        return $this->getTranslatableField('[', ']');
    }

    /**
     * @return string
     */
    public function getTranslatableDotField() {
        return $this->getTranslatableField('.');
    }

    /**
     * @return array
     */
    public function getTranslatableRules() {
        if (!($this instanceof Validatable)) {
            return [];
        }

        if ($this->isTranslatable()) {
            // Special things must be added for unique rule
            // https://github.com/codezero-be/laravel-unique-translation
            return [$this->getField() . '.*' => $this->rules()];
        }

        return [$this->getField() => $this->rules()];
    }

    /**
     * @return array
     */
    public function getTranslatableValidatorMessages() {
        if (!($this instanceof Validatable)) {
            return [];
        }

        $messages = [];

        if ($this->isTranslatable()) {
            $fieldPrefix = $this->getField() . '.*.';
        } else {
            $fieldPrefix = $this->getField() . '.';
        }

        foreach ($this->validatorMessages() as $key => $message) {
            $messages[$fieldPrefix . $key] = $message;
        }

        return $messages;
    }

    /**
     * Set value of model field.
     * @param $value
     * @return mixed
     */
    public function setTranslatableValue($value) {
        if ($this->isTranslatable() &&
            ($locale = $this->getTranslatableLocale()) &&
            method_exists($model = $this->getModel(), 'setTranslation'))
        {
            $model->setTranslation($this->getField(), $locale, $this->prepareTranslatableValue($value, $locale));
        } else {
            $this->setValue($value);
        }
    }

    /**
     * Prepare translatable value before set
     * @param $value
     * @param string|null $locale
     * @return mixed
     */
    public function prepareTranslatableValue($value, $locale = null) {
        // May be redeclared if needed
        return $this->prepareValue($value);
    }
}