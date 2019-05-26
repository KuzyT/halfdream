<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

/**
 * Trait HasUploadThumbnails
 * @package KuzyT\Halfdream\General\Traits
 * @property array $uploadThumbnails Can be added or not.
 */
trait HasUploadThumbnails
{
    /**
     * Array of width and height, in [width, height] order. Like:
     * [
     * [256, 256],
     * [256, null],
     * [null, 256]
     * ]
     * @var array
     */
    protected $_uploadThumbnails = [];

    /**
     * @return array
     */
    public function getUploadThumbnails() {
        if (property_exists($this, 'uploadThumbnails')) {
            // This order helps to redeclare class for helpers by addUploadThumbnail function
            return array_merge($this->uploadThumbnails, $this->_uploadThumbnails);
        }

        return $this->_uploadThumbnails;
    }

    /**
     * @param array $uploadThumbnails
     * @return $this
     * @throws \Exception
     */
    public function addUploadThumbnails($uploadThumbnails) {
        if ($this->isUploadThumbnailsArray($uploadThumbnails)) {
            if (!$this->hasUploadThumbnails($uploadThumbnails)) {
                $this->_uploadThumbnails[] = $uploadThumbnails;
            }
        } elseif (is_array($uploadThumbnails)) {
            foreach ($uploadThumbnails as $uploadThumbnail) {
                $this->addUploadThumbnails($uploadThumbnail);
            }
        } else {
            throw new \Exception('Upload Thumbnail array must be [$width, $height], like [256, 256], or [null, 256], or [256, null]');
        }

        return $this;
    }

    public function equalUploadThumnails($array1, $array2) {
        return count(array_diff_assoc($array1, $array2)) === 0;
    }

    /**
     * @param $uploadThumbnails
     * @return bool
     */
    public function isUploadThumbnailsArray($uploadThumbnails) {
        return is_array($uploadThumbnails) && count($uploadThumbnails) === 2 && !is_array($uploadThumbnails[0]) && !is_array($uploadThumbnails[1]);
    }

    /**
     * Delete exist upload Thumbnail.
     * @param array $uploadThumbnails
     */
    public function deleteUploadThumbnails($uploadThumbnails) {
        if ($this->hasUploadThumbnails($uploadThumbnails)) {
            // Deleting from both arrays

            if (property_exists($this, 'options')) {
                foreach ($this->uploadThumbnails as &$existUploadThumbnails) {
                    if ($this->equalUploadThumnails($uploadThumbnails, $existUploadThumbnails)) {
                        unset($existUploadThumbnails);
                    }
                }
            }

            foreach ($this->_uploadThumbnails as &$existUploadThumbnails) {
                if ($this->equalUploadThumnails($uploadThumbnails, $existUploadThumbnails)) {
                    unset($existUploadThumbnails);
                }
            }
        }
    }

    /**
     * @param array $uploadThumbnails
     * @return bool
     */
    public function hasUploadThumbnails($uploadThumbnails) {
        foreach ($this->getUploadThumbnails() as $existUploadThumbnails) {
            if ($this->equalUploadThumnails($uploadThumbnails, $existUploadThumbnails)) {
                return true;
            }
        }
        return false;
    }


}