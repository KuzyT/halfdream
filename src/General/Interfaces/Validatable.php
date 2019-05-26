<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 27.03.2019
 */

namespace KuzyT\Halfdream\General\Interfaces;

interface Validatable
{
    /**
     * Get the validation rule that apply to the request for current field.
     *
     * @return array rules for validating
     */
    public function rules();

    /**
     * Get the validation messages that apply to the request for current field.
     *
     * @return array messages for validating
     */
    public function validatorMessages();
}