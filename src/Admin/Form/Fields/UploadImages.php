<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 20.03.2019
 */

namespace KuzyT\Halfdream\Admin\Form\Fields;

use KuzyT\Halfdream\General\Traits\HasFromField;
use KuzyT\Halfdream\General\Traits\HasReadOnly;
use KuzyT\Halfdream\General\Traits\HasUploadThumbnails;

class UploadImages extends Field
{
    use HasReadOnly, HasUploadThumbnails, HasFromField;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.form.fields.uploadimages';

    public function __construct($field, string $label = '', $fromField = null, $fromFieldTitle = null)
    {
        parent::__construct($field, $label);
        $this->setFromField($fromField, $fromFieldTitle);
    }

    /**
     * @return array
     */
    public function getComponentTranslation() {
        return [
            'return' => __('halfdream::admin.image.return'),
            'remove' => __('halfdream::admin.image.remove'),
            'browse' => __('halfdream::admin.image.browse'),
            'notitle' => __('halfdream::admin.image.notitle', ['field' => $this->getFromFieldTitle() ? $this->getFromFieldTitle() : $this->getFromField()]),
            'delete' => [
                'title' => __('halfdream::admin.delete.title'),
                'message' => __('halfdream::admin.delete.message', ['module' => __('halfdream::admin.image.confirm_message_title')]),
                'confirm' => __('halfdream::admin.delete.confirm'),
                'cancel' => __('halfdream::admin.delete.cancel'),
            ],
            'error' => __('halfdream::admin.error.title'),
        ];
    }

    /**
     * @return array|mixed|null
     */
    public function getDisplayedValue() {
        $value = parent::getDisplayedValue();
        return $value ? explode(',', $value) : [];
    }

    /**
     * @return array
     */
    public function getImageUrls() {
        $images = [];
        foreach ($this->getDisplayedValue() as $value) {
            $images[$value] = image($value);
        }

        return $images;
    }

    /**
     * @return array
     */
    public function getThumbnailUrls() {
        $thumbnails = [];
        foreach ($this->getDisplayedValue() as $value) {
            $thumbnails[$value] = thumbnail($value);
        }

        return $thumbnails;
    }

    /**
     * @return array
     */
    public function getViewData() {
        return array_merge(parent::getViewData(), ['lang' => $this->getComponentTranslation(), 'fromField' => $this->getFromField(), 'readonly' => $this->getReadOnly(), 'images' => $this->getImageUrls(), 'thumbnails' => $this->getThumbnailUrls(), 'thumbnailSizes' => $this->getUploadThumbnails()]);
    }
}