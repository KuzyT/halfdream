<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.02.2019
 */

namespace KuzyT\Halfdream\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use KuzyT\Halfdream\Admin\Form\Cards\Card;
use KuzyT\Halfdream\Admin\Form\Fields\CheckBox;
use KuzyT\Halfdream\Admin\Form\Fields\CKEditor;
use KuzyT\Halfdream\Admin\Form\Fields\DatePicker;
use KuzyT\Halfdream\Admin\Form\Fields\DateTime;
use KuzyT\Halfdream\Admin\Form\Fields\EmailInput;
use KuzyT\Halfdream\Admin\Form\Fields\PasswordInput;
use KuzyT\Halfdream\Admin\Form\Fields\Radio;
use KuzyT\Halfdream\Admin\Form\Fields\Select;
use KuzyT\Halfdream\Admin\Form\Fields\SwitchCheckBox;
use KuzyT\Halfdream\Admin\Form\Fields\TimePicker;
use KuzyT\Halfdream\Admin\Form\Fields\UploadImage;
use KuzyT\Halfdream\Admin\Form\Fields\UploadImages;
use KuzyT\Halfdream\Admin\Form\Panels\Panel;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\General\Traits\IsGeneratable;
use KuzyT\Halfdream\Admin\Form\Fields\TextInput;
use KuzyT\Halfdream\Admin\Form\Fields\TextArea;
use KuzyT\Halfdream\Admin\Form\Buttons\Button;
use KuzyT\Halfdream\Admin\Form\Columns\Columns;
use KuzyT\Halfdream\Admin\Form\Modules\Display;

/**
 * Class HalfdreamFormElement
 * @package KuzyT\Halfdream\Admin
 *
 * @method static TextInput text(string $field, string $label = '') TextInput constructor.
 * @method static TextArea textarea(string $field, string $label = '') TextArea constructor.
 * @method static EmailInput email(string $field, string $label = '') EmailInput constructor.
 * @method static PasswordInput password(string $field, string $label = '', $reveal = true) PasswordInput constructor.
 * @method static DatePicker date(string $field, string $label = '', $editable = true) DatePicker constructor.
 * @method static CheckBox checkbox(string $field, string $placeholder = '', string $label = '') CheckBox constructor.
 * @method static SwitchCheckBox switch(string $field, string $placeholder = '', string $label = '') SwitchCheckBox constructor.
 * @method static TimePicker time(string $field, string $label = '', $editable = true) TimePicker constructor.
 * @method static DateTime datetime(string $field, string $label = '', $editable = true) DateTime constructor.
 * @method static Select select(string $field, string $label = '', $expanded = true) Select constructor.
 * @method static Radio radio(string $field, string $label = '', $isHorizontal = true) Radio constructor.
 * @method static UploadImage uploadimage(string $field, string $label = '', string $fromField = null, string $fromFieldTitle = null) UploadImage constructor.
 * @method static UploadImages uploadimages(string $field, string $label = '', string $fromField = null, string $fromFieldTitle = null) UploadImages constructor.
 * @method static CKEditor ckeditor(string $field, string $label = '') CKEditor constructor.
 *
 * @method static Button default(string $label = '') Button constructor.
 *
 * @method static Panel panel(string $label = '', $translatable = false) Panel constructor.
 *
 * @method static Card card(string $label = '', $translatable = false) Card constructor.
 *
 * @method static Columns columns(array $options = []) Columns constructor.
 *
 * @method static Display module(HalfdreamModule $module, array $options = [], string $label = '') Module Display constructor.
 */
class HalfdreamFormElement
{
    use IsGeneratable;

    /**
     * @var array
     */
    protected static $classes = [
        /**
         * Fields
         */
        'text' => TextInput::class,
        'textarea' => TextArea::class,
        'email' => EmailInput::class,
        'password' => PasswordInput::class,
        'date' => DatePicker::class,
        'checkbox' => CheckBox::class,
        'switch' => SwitchCheckBox::class,
        'time' => TimePicker::class,
        'datetime' => DateTime::class,
        'select' => Select::class,
        'radio' => Radio::class,
        'uploadimage' => UploadImage::class,
        'uploadimages' => UploadImages::class,
        'ckeditor' => CKEditor::class,

        /**
         * Buttons
         */
        'button' => Button::class,

        /**
         * Panels
         */
        'panel' => Panel::class,

        /**
         * Cards
         */
        'card' => Card::class,

        /**
         * Columns
         */
        'columns' => Columns::class,

        /**
         * Modules
         */
        'module' => Display::class
    ];

    /**
     * @param string $table Table in DB for slug unique check
     * @param array $options
     * @return Card Card with SEO form elements
     */
    public static function seo($table, $options = []) {
        $options = array_merge([
            'seo_image_field' => 'seo_image',
            'seo_url_field' => 'seo_url',
            'seo_title_field' => 'seo_title',
            'meta_description_field' => 'meta_description',
            'meta_keywords_field' => 'meta_keywords',
        ], $options);

        return static::card(__('halfdream::admin.seo.label'))->comprise([
            static::columns()
                ->addColumn([
                    static::uploadimage($options['seo_image_field'], __('halfdream::admin.seo.seo_image'), $options['seo_url_field'], $options['seo_title_field']),
                ], 5)
                ->addColumn([
                    static::text($options['seo_url_field'], __('halfdream::admin.seo.seo_url'))->unique($table)->required(),
                    static::text($options['seo_title_field'], __('halfdream::admin.seo.seo_title')),
                    static::textarea($options['meta_description_field'], __('halfdream::admin.seo.meta_description')),
                    static::textarea($options['meta_keywords_field'], __('halfdream::admin.seo.meta_keywords'))
                ], 7)
        ]);
    }
}
