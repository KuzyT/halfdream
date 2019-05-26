<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

class PasswordInput extends Input
{
    /**
     * @var string
     */
    protected $type = 'password';

    /**
     * @var string
     */
    protected $icon = 'unlock-alt';

    /**
     * PasswordInput constructor.
     * @param $field
     * @param string $label
     * @param bool $reveal
     */
    public function __construct($field, string $label = '', $reveal = true)
    {
        parent::__construct($field, $label);
        if ($reveal) {
            $this->setReveal();
        }
    }

    /**
     * @return $this
     */
    public function setReveal() {
        $this->addOption('password-reveal');
        return $this;
    }
}