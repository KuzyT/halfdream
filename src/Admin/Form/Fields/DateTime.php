<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 14.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

class DateTime extends Field
{
    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.datetime';

    /**
     * @var string
     */
    protected $icon = 'calendar-day';

    /**
     * DatePicker constructor.
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

        // Set fas iconpack by default
//        $this->setIconPack();
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
        return $value ? new \Carbon\Carbon($value) : null;
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
        return $value ? new \Carbon\Carbon($value) : null;
    }

    // todo - now it is hardcoded in component because of Buefy global config O_o
//    /**
//     * Set the correct icon pack for this custom component.
//     * @param string $iconPack
//     * @return $this
//     */
//    public function setIconPack($iconPack = 'fas') {
//        $this->addOption('icon-pack="'.$iconPack.'"');
//        return $this;
//    }
}