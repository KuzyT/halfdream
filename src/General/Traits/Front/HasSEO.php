<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 29.04.2019
 */

namespace KuzyT\Halfdream\General\Traits\Front;

/**
 * Trait HasSEO
 * @package KuzyT\Halfdream\General\Traits\Front
 */
trait HasSEO
{
    // You must add seo columns to translatable like:
    // public $translatable = ['seo_url', 'seo_title', 'seo_image', 'meta_description', 'meta_keywords'];

    /**
     * @return string
     */
    public function getSeoUrlField() {
        return 'seo_url';
    }

    /**
     * @return string
     */
    public function getSeoTitleField() {
        return 'seo_title';
    }

    /**
     * @return string
     */
    public function getSeoImageField() {
        return 'seo_image';
    }

    /**
     * @return string
     */
    public function getMetaDescriptionField() {
        return 'meta_description';
    }

    /**
     * @return string
     */
    public function getMetaKeywordsField() {
        return 'meta_keywords';
    }

    /**
     * @param string $ogType
     * @param string $titleField
     * @param string $contentField
     * @param string $imageField
     * @return array
     */
    public function getMeta($ogType = 'article', $titleField = 'title', $contentField = 'content', $imageField = 'image') {
        /**
         * Seo - todo - make it prettify
         */
        $meta = [];

        $meta['title'] = $meta['ogtitle'] = $this->getAttribute($this->getSeoTitleField()) ?: $this->getAttribute($titleField);
        $meta['description'] = $meta['ogdescription'] = $this->getAttribute($this->getMetaDescriptionField()) ?: strip_tags($this->getAttribute($contentField));
        if ($this->getAttribute($this->getSeoImageField()) || $this->getAttribute($imageField)) {
            $meta['ogimage'] = image($this->getAttribute($this->getSeoImageField()) ? $this->getAttribute($this->getSeoImageField()) : $this->getAttribute($imageField));
        }
        if ($this->getAttribute($this->getMetaKeywordsField())) {
            $meta['keywords'] = $this->getAttribute($this->getMetaKeywordsField());
        }

        $meta['ogtype'] = $ogType;

        return $meta;
    }
}
