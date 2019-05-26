<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 12.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasWidth
 * @package KuzyT\Halfdream\General\Traits
 * @property string $content Can be added or not.
 */
trait HasContent
{
    /**
     * @var null|string
     */
    protected $_content = null;

    /**
     * @return string
     */
    public function getContent() {
        if (empty($this->_content) && property_exists($this, 'content')) {
            return $this->content;
        }

        return $this->_content;
    }

    /**
     * @param mixed $content
     * @return $this
     */
    public function setContent($content) {
        $this->_content = $content;
        return $this;
    }
}