<?php

namespace KuzyT\Halfdream\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KuzyT\Halfdream\General\Traits\Front\HasSEO;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, HasTranslations, HasSEO;

    public $timestamps = false;

    public $translatable = ['title', 'content', 'seo_url', 'seo_title', 'seo_image', 'meta_description', 'meta_keywords'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
