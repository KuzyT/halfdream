<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 01.03.2019
 */

namespace KuzyT\Halfdream\Admin\Display\Columns;
use Illuminate\Support\Str;
use KuzyT\Halfdream\General\Traits\HasMaxSize;
use KuzyT\Halfdream\Facades\Halfdream;

class HtmlColumn extends Column
{
    use HasMaxSize;

    /**
     * @var string
     */
    protected $view = 'halfdream::admin.display.columns.html';

    /**
     * @var int Text display limit for value, null or 0 for unlimited.
     */
    protected $maxSize = 100;

    /**
     * Get value of model field.
     * @return mixed|null
     */
    public function getDisplayedValue() {
        $value = parent::getDisplayedValue();
        // Close tags after text limit
        return $this->getMaxSize() ? Halfdream::closeTags(Str::limit($value, $this->getMaxSize())) : $value;
    }
}
