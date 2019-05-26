<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 28.02.2019
 */

namespace KuzyT\Halfdream\Admin;

use KuzyT\Halfdream\Admin\Display\Columns\ActionsColumn;
use KuzyT\Halfdream\Admin\Display\Columns\BooleanColumn;
use KuzyT\Halfdream\Admin\Display\Columns\IconColumn;
use KuzyT\Halfdream\Admin\Display\Columns\ImageColumn;
use KuzyT\Halfdream\General\Traits\IsGeneratable;
use KuzyT\Halfdream\Admin\Display\Columns\HtmlColumn;
use KuzyT\Halfdream\Admin\Display\Columns\TextColumn;

/**
 * Class HalfdreamDisplayElement
 * @package KuzyT\Halfdream\Admin
 *
 * @method static TextColumn text(string $field, string $label = '') TextColumn constructor.
 * @method static HtmlColumn html(string $field, string $label = '') HtmlColumn constructor.
 * @method static ActionsColumn actions(string $label = '') ActionsColumn constructor.
 * @method static ImageColumn image(string $field, string $label = '') ImageColumn constructor.
 * @method static BooleanColumn boolean(string $field, string $label = '') BooleanColumn constructor.
 * @method static IconColumn icon(string $field, string $label = '') IconColumn constructor.
 */
class HalfdreamDisplayElement
{
    use IsGeneratable;

    /**
     * @var array
     */
    protected static $classes = [
        'text' => TextColumn::class,
        'html' => HtmlColumn::class,
        'actions' => ActionsColumn::class,
        'image' => ImageColumn::class,
        'boolean' => BooleanColumn::class,
        'icon' => IconColumn::class
    ];
}
