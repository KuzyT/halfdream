<?php

namespace KuzyT\Halfdream\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KuzyT\Halfdream\General\Traits\Front\HasGallery;
use KuzyT\Halfdream\General\Traits\Front\HasSEO;
use KuzyT\Halfdream\General\Traits\Front\HasStatus;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use SoftDeletes, HasTranslations, HasSEO, HasStatus, HasGallery;

    public $translatable = ['title', 'content', 'status', 'image', 'gallery', 'published_at', 'seo_url', 'seo_title', 'seo_image', 'meta_description', 'meta_keywords'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function getPublishedAttribute() {
        return $this->published_at ? new \Carbon\Carbon($this->published_at) : null;
    }
}
