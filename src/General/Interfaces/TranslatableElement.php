<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.03.2019
 */

namespace KuzyT\Halfdream\General\Interfaces;

interface TranslatableElement extends Translatable
{
    /**
     * @return string
     */
    public function getTranslatableValue();

    /**
     * @param string $localePrefix
     * @param string $localeSuffix
     * @return string
     */
    public function getTranslatableField($localePrefix = '', $localeSuffix = '');

    /**
     * @return string
     */
    public function getTranslatableDisplayField();

    /**
     * @return string
     */
    public function getTranslatableDotField();

    /**
     * @return array
     */
    public function getTranslatableRules();

    /**
     * @return array
     */
    public function getTranslatableValidatorMessages();
}