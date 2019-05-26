<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 30.04.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use CodeZero\UniqueTranslation\UniqueTranslationRule;

/**
 * Trait HasUnique.
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasUnique
{
    /**
     * @var string
     */
    public static $constUnique= 'unique';

    /**
     * @var null|string
     */
    protected $uniqueTable = null;

    /**
     * @param $table
     * @return $this
     */
    public function unique($table) {
        $this->uniqueTable = $table;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUnique() {
        return !!$this->uniqueTable;
    }

    /**
     * @param &array $rules
     */
    public function addRuleUnique(&$rules)
    {
        if ($this->isUnique()) {
            if (method_exists($this, 'isTranslatable') && $this->isTranslatable()) {
                $rule = UniqueTranslationRule::for($this->uniqueTable, $this->getField());
                if (method_exists($this, 'getModel') && $model = $this->getModel()) {
                    $rule = $rule->ignore($model->{$model->getKeyName()}, $model->getKeyName());
                }
            } else {
                $rule = \Illuminate\Validation\Rule::unique($this->uniqueTable);
                if (method_exists($this, 'getModel') && $model = $this->getModel()) {
                    $rule = $rule->ignore($model->{$model->getKeyName()}, $model->getKeyName());
                }
            }
            $rules[] = $rule;
        }
    }

    /**
     * @param &array $messages
     */
    public function addValidatorMessageUnique(&$messages)
    {
        if ($this->isUnique()) {
            $messages['unique_translation'] = __('halfdream::admin.validation.unique_translation');
        }
    }
}
