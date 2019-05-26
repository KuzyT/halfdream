<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 12.03.2019
 */

namespace KuzyT\Halfdream\General;

use KuzyT\Halfdream\General\Scripts\Custom;
use KuzyT\Halfdream\General\Scripts\Locale;
use KuzyT\Halfdream\General\Scripts\Script;
use KuzyT\Halfdream\General\Traits\IsGeneratable;
use KuzyT\Halfdream\General\Traits\HasView;

/**
 * Class HalfdreamFormField
 * @package KuzyT\Halfdream\Admin
 *
 * @method Custom custom(string $content = '') Add custom script.
 * @method Locale locale(string $content = '') Add locale script.
 */
class HalfdreamScript
{
    use IsGeneratable, HasView;

    /**
     * @var string
     */
    protected $view = 'halfdream::general.scripts';

    /**
     * @var array
     */
    protected static $classes = [
        'custom' => Custom::class,
        'locale' => Locale::class
    ];

    /**
     * Non-static magic calls - add instances if not singleton.
     * If it is - only return exists one. So there are no $arguments in singleton classes.
     * @param $name
     * @param $arguments
     * @return Script
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (!key_exists($name, $classes = static::getClasses())) {
            throw new \Exception("No Class with name '$name' exists.");
        }

        $scriptClass = $classes[$name];
        if (!(with(new $scriptClass(...$arguments))->isSingle() && $script = $this->getSingleScript($scriptClass))) {
            $script = static::__callStatic($name, $arguments);
            $this->add($script);
        }

        return $script;
    }

    /**
     * @var Script[]
     */
    protected $scripts = null;

    public function __construct()
    {
        $this->scripts = [];
    }

    public function add(Script $script) {
        $this->scripts[] = $script;
        return $this;
    }

    public function get() {
        return $this->scripts;
    }

    public function getSingleScript($class) {
        foreach ($this->scripts as $script) {
            if ($script instanceof $class) return $script;
        }
        return null;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return ['scripts' => $this->get()];
    }
}