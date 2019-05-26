<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 18.03.2019
 */

namespace KuzyT\Halfdream\Http\Controllers\Admin;

use KuzyT\Halfdream\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use KuzyT\Halfdream\Http\Requests\Admin\Image as ImageRequest;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Uploading images from field form.
     * @param ImageRequest $request
     * @return JsonResponse
     */
    public function image(ImageRequest $request)
    {
        $image = $request->file('file');

        if ($title = $request->get('title', null)) {
            $filename = \Halfdream::makeSeoUploadedFilename(
                $image,
                config('halfdream.uploads.images.path'),
                $title
            );

            \Storage::disk(config('halfdream.uploads.storage'))->putFileAs( config('halfdream.uploads.images.path'), $image, $filename);
        } else {
            $filename = basename(\Storage::disk(config('halfdream.uploads.storage'))->putFile( config('halfdream.uploads.images.path'), $image));
        }

        // If there is sizes for additional thumbnails (except the default one), creating them
        $thumbnailSizes = [];
        if ($sizes = $request->get('sizes')) {
            $sizes = json_decode($sizes);
            foreach ($sizes as $size) {
                $thumbnailSizes[\Halfdream::thumbnailSize($size[0], $size[1])] = thumbnail($filename, $size[0], $size[1], true);
            }
        }

        $response = [
            'image' => image($filename),
            'thumbnail' => thumbnail($filename, null, null, true), // Default size, but autocreate must be true
            'value' => $filename,
        ];

        if ($thumbnailSizes) {
            $response['sizes'] = $thumbnailSizes;
        }

        return new JsonResponse($response);
    }
}
