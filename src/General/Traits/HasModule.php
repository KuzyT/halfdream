<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.05.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use KuzyT\Halfdream\General\HalfdreamModule;

/**
 * Trait HasModule
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasModule
{
    /**
     * @var \KuzyT\Halfdream\General\HalfdreamModule
     */
    protected $module;

    /**
     * @var array
     */
    protected $moduleOptions;

    /**
     * @return \KuzyT\Halfdream\General\HalfdreamModule
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * @param \KuzyT\Halfdream\General\HalfdreamModule $module
     * @param array $moduleOptions
     * @return $this
     */
    public function setModule(HalfdreamModule $module, $moduleOptions = []) {
        $this->module = $module;
        if ($moduleOptions) {
            $this->setModuleOptions($moduleOptions);
        }
        return $this;
    }

    /**
     * @param array $moduleOptions
     * @return $this
     */
    public function setModuleOptions($moduleOptions = []) {
        $this->moduleOptions = $moduleOptions;
        return $this;
    }

    /**
     * @return array
     */
    public function getModuleOptions() {
        return $this->moduleOptions;
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator|null $collection
     * @param array $options
     * @return \KuzyT\Halfdream\Admin\Display\Display
     */
    public function getModuleDisplay($collection = null, $options = [])
    {
        return $this->module->initDisplay($collection, array_merge($this->getModuleOptions(), $options));
    }

    /**
     * @return string|null
     */
    public function getModuleTitle()
    {
        return $this->module->getTitle('display');
    }
}
