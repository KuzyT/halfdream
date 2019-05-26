<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

class TimePicker extends Field
{
    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.timepicker';

    /**
     * @var string
     */
    protected $icon = 'clock';

    /**
     * TimePicker constructor.
     * @param $field
     * @param string $label
     * @param bool $editable
     */
    public function __construct($field, string $label = '', $editable = true)
    {
        parent::__construct($field, $label);
        if ($editable) {
            $this->setEditable();
        }
    }

    /**
     * @return $this
     */
    public function setEditable() {
        $this->addOption('editable');
        return $this;
    }

    /**
     * Prepare value before set
     * @param $value
     * @return mixed
     */
    public function prepareValue($value) {
        return new \Carbon\Carbon($value);
    }

    /**
     * Prepare translatable value before set
     * @param $value
     * @param string|null $locale
     * @return mixed
     */
    public function prepareTranslatableValue($value, $locale = null) {
        return $value;
    }

    /**
     * Handler for translatable value getter.
     * @param $value
     * @param string|null $locale
     * @return mixed
     */
    public function getTranslatableValueHandler($value, $locale = null) {
        return new \Carbon\Carbon($value);
    }
}