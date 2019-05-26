<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use Illuminate\View\View;

/**
 * Trait HasView
 * @package KuzyT\Halfdream\General\Traits
 * @property string $view Can be added or not.
 */
trait HasView
{
    /**
     * @var string
     */
    protected $_view;

    /**
     * @return string
     */
    public function getView() {
        if (empty($this->_view) && property_exists($this, 'view')) {
            return $this->view;
        }
        return $this->_view;
    }

    /**
     * @param @param string $view
     * @return $this
     */
    public function setView($view) {
        $this->_view = $view;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return [];
    }

    /**
     * @return View
     */
    public function view() {
        return view($this->getView(), $this->getViewData());
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function __toString()
    {
        return (string) $this->render();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function render() {
        return $this->view()->render();
    }
}