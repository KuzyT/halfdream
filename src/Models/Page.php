<?php

namespace KuzyT\Halfdream\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KuzyT\Halfdream\General\Traits\Front\HasGallery;
use KuzyT\Halfdream\Traits\Orderable;
use KuzyT\Halfdream\General\Traits\Front\HasSEO;
use KuzyT\Halfdream\General\Traits\Front\HasStatus;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use Orderable, SoftDeletes, HasTranslations, HasSEO, HasStatus, HasGallery;

    public $timestamps = false;

    public $translatable = ['title', 'content', 'status', 'image', 'gallery', 'seo_url', 'seo_title', 'seo_image', 'meta_description', 'meta_keywords'];
}
