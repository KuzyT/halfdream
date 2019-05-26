<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 29.03.2019
 */

namespace KuzyT\Halfdream\Admin\Navigation;

use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\General\Interfaces\Comprisable;
use KuzyT\Halfdream\General\Page\PageElement;
use KuzyT\Halfdream\General\Traits\HasIcon;
use KuzyT\Halfdream\General\Traits\HasLabel;
use KuzyT\Halfdream\General\Traits\HasLink;
use KuzyT\Halfdream\General\Traits\IsComprisable;

class NavigationLink extends PageElement implements Comprisable
{
    use IsComprisable;
    use HasLink { getLink as public getLinkTrait; }
    use HasIcon { getIcon as public getIconTrait; }
    use HasLabel { getLabel as public getLabelTrait; }

    // todo - it has view, but now it is not used. Maybe refacro for that.

    /**
     * @var int Incremental variable for aria-id in collapse Buefy component.
     * https://buefy.org/documentation/collapse/
     */
    protected static $nextContainerID = 1;

    /**
     * @return int
     */
    protected static function nextContainerID() {
        return static::$nextContainerID++;
    }

    /**
     * @var int
     */
    protected $containerID;

    /**
     * @return int|null
     */
    public function getContainerID () {
        return $this->containerID;
    }

    /**
     * @var HalfdreamModule Module for ModuleLink
     */
    protected $module;

    /**
     * @var bool sign if link from module must be for admin area
     */
    protected $moduleIsAdmin = false;

    /**
     * NavigationLink constructor.
     * @param string|null $link
     * @param string|null $label
     * @param string|null $icon
     * @param bool $translateLabel
     */
    protected function __construct($label = null, $link = null, $icon = null, $translateLabel = false)
    {
        $this->setLink($link);
        $this->setLabel($label, $translateLabel);
        $this->setIcon($icon);
    }

    /**
     * @param string|null $label
     * @param string|null $link
     * @param string|null $icon
     * @param bool $translateLabel
     * @return NavigationLink
     */
    public static function link($label = null, $link = null, $icon = null, $translateLabel = false) {
        return new static(
            $label,
            $link,
            $icon,
            $translateLabel
        );
    }

    /**
     * @param string|null $label
     * @param bool $translateLabel
     * @return NavigationLink
     */
    public static function label($label = null, $translateLabel = false) {
        return new static(
            $label,
            null,
            null,
            $translateLabel
        );
    }

    /**
     * @param string|null $label
     * @param array $comprisable
     * @param string|null $icon
     * @param bool $translateLabel
     * @return NavigationLink
     */
    public static function container($label = null, $comprisable = [], $icon = null, $translateLabel = false) {
        $container = new static($label, null, $icon, $translateLabel);
        $container->containerID = static::nextContainerID();

        if ($comprisable) {
            $container->comprise($comprisable);
        }

        return $container;
    }

    /**
     * @param string $moduleClass HalfdreamModule class.
     * @param bool $moduleIsAdmin
     * @return NavigationLink
     */
    public static function module($moduleClass, $moduleIsAdmin = false) {
        $link = new static();
        $link->module = with(new $moduleClass);
        $link->moduleIsAdmin = $moduleIsAdmin;
        return $link;
    }

    /**
     * @param string $moduleClass HalfdreamModule class.
     * @return NavigationLink
     */
    public static function adminModule($moduleClass) {
        return static::module($moduleClass, true);
        // In service provider there is error - route not registered yet.
        // Well, in this version - we'll keep a module here.
        // And an admin sign
//        $module = with(new $moduleClass);
//        return new static(
//            $module->getTitle(),
//            $module->getAdminLink(),
//            $module->getIcon()
//        );
    }

    protected function getModuleLink() {
        return $this->module
            ? (
                $this->moduleIsAdmin ? $this->module->getAdminLink() : $this->module->getLink()
            )
            : null;
    }

    protected function getModuleLabel() {
        return $this->module ? $this->module->getTitle() : null;
    }

    protected function getModuleIcon() {
        return $this->module ? $this->module->getIcon() : null;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->getModuleLink() ?: $this->getLinkTrait();
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->getModuleLabel() ?: $this->getLabelTrait();
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->getModuleIcon() ?: $this->getIconTrait();
    }

    /**
     * @return bool
     */
    public function isContainer() {
        return $this->hasComprised();
    }

    /**
     * @return bool
     */
    public function isLink() {
        // If you want to make a Home link, you must use '/' rather than empty link ''
        return !!$this->getLink();
    }

    /**
     * @return bool
     */
    public function isLabel() {
        return !$this->isLink() && !$this->isContainer();
    }

    /**
     * @param string $pattern
     * @param bool $adminMainPagePattern
     * @return bool
     */
    public function isActive($pattern = '*', $adminMainPagePattern = false) {
        if ($this->isContainer()) {
            foreach ($this->comprised() as $link) {
                if ($link->isActive($pattern)) {
                    return true;
                }
            }
        } elseif ($this->isLink()) {
            $linkUrl = parse_url($this->getLink());
            // hmmm... maybe it can be more beautiful
            // 'host' key must be in url('') helper for main page
            if (key_exists('host', $linkUrl) && $linkUrl['host'] != parse_url(url(''))['host']) {
                return false;
            }
            if (key_exists('path', $linkUrl) && !in_array($linkUrl['path'], ['/', ''])) {
                $path = preg_replace(['~^(\/)+~', '~(\/)+$~'], ['', ''], $linkUrl['path']);
                return \Request::is($path . ($path == config('halfdream.admin.route')
                        ? ($adminMainPagePattern ? $pattern : '')
                        : $pattern));
            } else {
                // Is main page?
                $current = parse_url(url()->current());

                if (!key_exists('path', $current) || $current['path'] == '/') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrl() {
        return url($this->getLink());
    }
}
