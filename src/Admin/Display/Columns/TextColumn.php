<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.02.2019
 */

namespace KuzyT\Halfdream\Admin\Display\Columns;

use Illuminate\Support\Str;
use KuzyT\Halfdream\General\Traits\HasMaxSize;

class TextColumn extends Column
{
    use HasMaxSize;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.display.columns.text';

    /**
     * @var int Text display limit for value, null or 0 for unlimited.
     */
    protected $maxSize = 100;

    /**
     * Get value of model field.
     * @return mixed|null
     */
    public function getDisplayedValue() {
        // Strip tags - for html content
        $value = strip_tags(parent::getDisplayedValue());
        // Text limit is used here because it must be limited after strip tags
        return $this->getMaxSize() ? Str::limit($value, $this->getMaxSize()) : $value;
    }
}
