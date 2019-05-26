<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 23.05.2019
 */

namespace KuzyT\Halfdream\General\Traits\Front;

/**
 * Trait HasGallery
 * @package KuzyT\Halfdream\General\Traits\Front
 */
trait HasGallery
{
    /**
     * @param bool $thumbnail
     * @param int $width
     * @param int $height
     * @return \Illuminate\Support\Collection
     */
    protected function galleryImagesUrl($thumbnail = false, $width = null, $height = null) {
        if ($this->gallery) {
            return collect(explode(',', $this->gallery))->map(function($item) use ($thumbnail, $width, $height) {
                return $thumbnail ? thumbnail($item, $width, $height) : image($item);
            });
        }
        return collect();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getGalleryImagesAttribute() {
        return $this->galleryImagesUrl();
    }

    /**
     * @param int $width
     * @param int $height
     * @return \Illuminate\Support\Collection
     */
    public function galleryThumbnails($width = null, $height = null) {
        return $this->galleryImagesUrl(true, $width, $height);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getGalleryThumbsAttribute() {
        return $this->galleryThumbnails(config('halfdream.uploads.images.thumbnails.size.width'), config('halfdream.uploads.images.thumbnails.size.width'));
    }
}