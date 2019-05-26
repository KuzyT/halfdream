<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 19.02.2019
 */

namespace KuzyT\Halfdream;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use KuzyT\Halfdream\Admin\HalfdreamFormElement;
use KuzyT\Halfdream\Admin\Navigation\NavigationLink;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\General\HalfdreamScript;
use KuzyT\Halfdream\General\Interfaces\Comprisable;
use KuzyT\Halfdream\General\Interfaces\TranslatableElement;
use KuzyT\Halfdream\Models\Icon;
use KuzyT\Halfdream\Models\Menu;
use League\Flysystem\FileNotFoundException;
use Sokil\IsoCodes\IsoCodesFactory;

class Halfdream
{
     /**
     * @var string[]
     */
    protected $modules = [];

    /**
     * @var null
     */
    protected $setting_cache = null;

    /**
     * @var HalfdreamScript
     */
    protected $script = null;

    /**
     * @var NavigationLink[]
     */
    protected $adminNavigation = [];

    public function __construct()
    {
        $this->script = new HalfdreamScript();
    }

    /**
     * @param $key
     * @param null $default
     * @return string
     */
    public function setting($key, $default = null)
    {
        // todo - return setting
        return '';
    }

    /**
     * Old function for tags closion with DOM. Maybe must replaced.
     */
    public function closeTags($text) {
        if (!trim($text)) {
            return '';
        }
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();
        $text = $doc->saveHTML();
        return substr($text, 119, strlen($text) - 119 - 15);
    }

    /**
     * @param string|string[] $halfdreamModule
     */
    public function addModule($halfdreamModule) {
        if (is_array($halfdreamModule)) {
            foreach ($halfdreamModule as $module) {
                $this->addModule($module);
            }
        } else {
            $this->modules[] = $halfdreamModule;
        }
    }

    /**
     * @param string $key
     * @return null|\KuzyT\Halfdream\General\HalfdreamModule
     */
    public function loadModuleByKey($key) {
        foreach ($this->modules as $module) {
            if (with(new $module)->getKey() == $key) return new $module;
        }
        return null;
    }

    /**
     * @param string $modelClass
     * @return null|\KuzyT\Halfdream\General\HalfdreamModule
     */
    public function loadModuleByModelClass($modelClass) {
        foreach ($this->modules as $module) {
            if (with(new $module)->getModelClass() == $modelClass) return new $module;
        }
        return null;
    }

    /**
     * @return \KuzyT\Halfdream\General\HalfdreamScript
     */
    public function script() {
        return $this->script;
    }

    /**
     * Seo-link
     */
    public function makeSeoTitle($name, $length = 60, $locale = null)
    {
        return $this->makeSeo($name, $length, false);
    }

    /**
     * Seo-file
     */
    public function makeSeoFile($name, $length = 60, $locale = null)
    {
        return $this->makeSeo($name, $length, true, $locale);
    }

    /**
     * Seo (base function)
     */
    private function makeSeo($name, $length, $is_file, $locale = null)
    {
        if (!$locale) {
            $locale = $this->locale();
        }
        /**
         * It uses 'A PHP port of URLify.js from the Django project'
         * If someone know, should I add an extra license about it,
         * more than dependency in composer - please, tell me that,
         * cause i'm not good in such license questions.
         */
        return \URLify::filter($name, $length, $locale, $is_file);
    }

    /**
     * Check if filename is available, and make a new if it not.
     * @param $file
     * @param $path
     * @param string $title
     * @return string
     */
    public function makeSeoUploadedFilename(UploadedFile $file, $path, $title = null)
    {
        // Name
        $extension = $file->getClientOriginalExtension();
        $filename = basename($file->getClientOriginalName(), '.' . $extension);

        $title = $this->makeSeoFile($title) ? $this->makeSeoFile($title) : $this->makeSeoFile($filename);

        // First filename will be without numbers, second - <basename>-1.<extension>, and so on...
        $i = 1;
        $basename = $title;

        while (\Storage::disk(config('halfdream.uploads.storage'))->exists($path . '/' . $title . '.' . $extension)) {
        $title = $basename . "-" . $i;
            $i++;
        }

        return $title . '.' . $extension;
    }

    /**
     * @param $file
     * @param $path
     * @param string $default
     * @return string
     */
    private function getFileUrl($file, $path, $default = '')
    {
        if (!empty($file)) {
            return \Storage::disk(config('halfdream.uploads.storage'))->url($path . '/' . $file);
        }

        return $default;
    }

    /**
     * @param $path
     * @return bool
     */
    public function isUrl($path) {
        return !!parse_url($path, PHP_URL_SCHEME);
    }

    /**
     * @param $file
     * @param string $default
     * @return string
     */
    public function image($file, $default = '')
    {
        if (static::isUrl($file)) {
            return $file;
        }

        return $this->getFileUrl($file, config('halfdream.uploads.images.path'), $default);
    }

    /**
     * @param $file
     * @param int|null $width
     * @param int|null $height
     * @param bool|null $autocreate
     * @param string $default
     * @return string
     */
    public function thumbnail($file, $width = null, $height = null, $autocreate = null, $default = '')
    {
        if (static::isUrl($file)) {
            return $file;
        }

        if ($autocreate === null) {
            $autocreate = config('halfdream.uploads.images.thumbnails.autocreate');
        }

        if (!$width && !$height) {
            $width = config('halfdream.uploads.images.thumbnails.size.width');
            $height = config('halfdream.uploads.images.thumbnails.size.height');
        }

        $path_parts = pathinfo($file);
        $filename = key_exists('filename', $path_parts) ? $path_parts['filename'] : '';
        $extension = key_exists('extension', $path_parts) ? $path_parts['extension'] : '';

        $thumbnailFile = !empty($file) ? $filename . '-' . $this->thumbnailSize($width, $height) . '.' . $extension : '';

        // If autocreate is true, then we check if original file exists, then that thumbnail exists. If not, creating it.
        if ($autocreate
            && !empty($file)
            && \Storage::disk(config('halfdream.uploads.storage'))->exists(config('halfdream.uploads.images.path') . '/' . $file)
            && !\Storage::disk(config('halfdream.uploads.storage'))->exists(config('halfdream.uploads.images.thumbnails.path') . '/' . $thumbnailFile)) {
            // We already checked exists, but PHP still think it can be file not found error here
            try {
                $originalImage = \Storage::disk(config('halfdream.uploads.storage'))->get(config('halfdream.uploads.images.path') . '/' . $file);
            } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
                return $default;
            }

            $thumbnailImage = \Image::make($originalImage);

            // Different behavior when only width or height is here
            if ($width && $height) {
                // fit that size
                $thumbnailImage->fit($width, $height);
            } elseif ($width) {
                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $thumbnailImage->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } elseif ($height) {
                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $thumbnailImage->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            // Else - it will be original

            // Not 'putFileAs' cause it is stream resource file from Intervention
            \Storage::disk(config('halfdream.uploads.storage'))->put( config('halfdream.uploads.images.thumbnails.path') . '/' . $thumbnailFile, $thumbnailImage->stream());
        }

        return $this->getFileUrl($thumbnailFile, config('halfdream.uploads.images.thumbnails.path'), $default);
    }

    public function thumbnailSize($width = null, $height = null) {
        // Default behavior
        if (!$width && !$height) {
            $width = config('halfdream.uploads.images.thumbnails.size.width');
            $height = config('halfdream.uploads.images.thumbnails.size.height');
        }

        // Part of suffix for file, based are width and height both not null or not
        if ($width && $height) {
            return $width . 'x' . $height;
        } elseif ($width) {
            return 'w' . $width;
        } elseif ($height) {
            return 'h' . $height;
        } else {
            return 'original';
        }
    }

    /**
     * @param $file
     * @param string $default
     * @return string
     */
    public function file($file, $default = '')
    {
        return $this->getFileUrl($file, config('halfdream.uploads.files.path'), $default);
    }

    /**
     * Get current app locale (set it from session if different). May have parameter to set it.
     * Keep it in session.
     * @param string|null $locale
     * @return string
     */
    public function locale($locale = null) {
        if ($locale) {
            session()->put('locale', $locale);
        }

        // If locale is in session, but wasn't setted yet - set it now
        if (($locale = session()->get('locale')) && ($locale != app()->getLocale())) {
            app()->setLocale($locale);
        }

        return app()->getLocale();
    }

    /**
     * Get all locale list. Alias for config.
     * @return array
     */
    public function locales() {
        return config('halfdream.locale.list');
    }

    /**
     * Return if multilocale mode is enable.
     * @return bool
     */
    public function multiLocale() {
        return config('halfdream.locale.multi');
    }

    /**
     * Return country code by language code.
     * There is no direct match between ISO 639(languages codes) and ISO 3166 (countries codes).
     * But for pretty flags near languages label, there is a dictionary for that.
     * If it is empty, Halfdream will use a language code. But there can be no correct image for that.
     * Here are some help info (for used languages in countries)
     * https://wiki.openstreetmap.org/wiki/Nominatim/Country_Codes
     *
     * @param string|null $locale
     * @return string
     */
    public function countryByLocale($locale = null) {
        if (!$locale) {
            $locale = $this->locale();
        }

        if (key_exists($locale, config('halfdream.locale.countries'))) {
            return config('halfdream.locale.countries.'.$locale);
        } else {
            return $locale;
        }
    }

    /**
     * Get display string for locale - with name, flag, etc., based on additional options.
     * @param string|null $locale
     * @return string|null
     */
    public function localeDisplay($locale = null/*, $options = []*/) {
        if (!$locale) {
            $locale = $this->locale();
        }

        if ($language = $this->getISOLanguage($locale)) {
            return \Illuminate\Support\Str::ucfirst($language->getLocalName());
        } else {
            return null;
        }
    }

    /**
     * @var IsoCodesFactory
     */
    protected $isoCodes;

    /**
     * @param $locale
     * @return null|\Sokil\IsoCodes\Database\Languages\Language
     */
    public function getISOLanguage($locale) {
        if (!$this->isoCodes) {
            $this->isoCodes = new IsoCodesFactory();
        }
        $languages = $this->isoCodes->getLanguages();
        $language = $languages->getByAlpha2($locale);
        return $language;
    }

    /**
     * Determine if the session contains old input.
     * Unlike Request::session()->hasOldInput() version,
     * it returns true even if input value is empty.
     * And has no default param.
     *
     * @param string $key
     * @return bool
     */
    public function hasOldInput($key) {
        return \Illuminate\Support\Arr::has(\Request::session()->get('_old_input', []), $key);
    }

    /**
     * @param \KuzyT\Halfdream\General\Interfaces\Comprisable $comprisable
     * @return array
     */
//    public function comprisableFields(Comprisable $comprisable) {
//        $fields = [];
//        foreach ($comprisable->comprised() as $element) {
//            if ($element instanceof Comprisable) {
//                $fields = array_merge($fields, $this->comprisableFields($element));
//            } elseif ($element instanceof TranslatableElement) {
//                if ($element->isTranslatable()) {
//                    foreach (\Halfdream::locales() as $locale) {
//                        $element->setTranslatableLocale($locale);
//                        $fields[] = $element->getTranslatableDisplayField();
//                    }
//                } else {
//                    $fields[] = $element->getTranslatableDisplayField();
//                }
//            }
//        }
//        return $fields;
//    }

    /**
     * @param \KuzyT\Halfdream\General\Interfaces\Comprisable $comprisable
     * @return array
     */
    public function comprisableValidatorRules(Comprisable $comprisable) {
        $rules = [];
        foreach ($comprisable->comprised() as $element) {
            if ($element instanceof Comprisable) {
                $rules = array_merge($rules, $this->comprisableValidatorRules($element));
            } elseif ($element instanceof TranslatableElement) {
                $rules = array_merge($rules, $element->getTranslatableRules());
            }
        }
        return $rules;
    }

    /**
     * @param \KuzyT\Halfdream\General\Interfaces\Comprisable $comprisable
     * @return array
     */
    public function comprisableValidatorMessages(Comprisable $comprisable) {
        $messages = [];
        foreach ($comprisable->comprised() as $element) {
            if ($element instanceof Comprisable) {
                $messages = array_merge($messages, $this->comprisableValidatorMessages($element));
            } elseif ($element instanceof TranslatableElement) {
                $messages = array_merge($messages, $element->getTranslatableValidatorMessages());
            }
        }
        return $messages;
    }

    /**
     * @param \KuzyT\Halfdream\General\Interfaces\Comprisable $comprisable
     * @return array
     */
    public function comprisableValidatorAttributeNames(Comprisable $comprisable) {
        $fields = [];
        foreach ($comprisable->comprised() as $element) {
            if ($element instanceof Comprisable) {
                $fields = array_merge($fields, $this->comprisableValidatorAttributeNames($element));
            } elseif ($element instanceof TranslatableElement) {
                if (method_exists($element, 'getLabel') && $label = $element->getLabel()) {
                    if ($element->isTranslatable()) {
                        foreach (\Halfdream::locales() as $locale) {
                            $element->setTranslatableLocale($locale);
                            $fields[$element->getTranslatableDotField()] = $label;
                        }
                    } else {
                        $fields[$element->getTranslatableDotField()] = $label;
                    }
                }
            }
        }
        return $fields;
    }

    /**
     * @param \KuzyT\Halfdream\General\Interfaces\Comprisable $comprisable
     * @param $values
     */
    public function comprisableSetValues(Comprisable $comprisable, $values) {
        foreach ($comprisable->comprised() as $element) {
            if ($element instanceof Comprisable) {
                $this->comprisableSetValues($element, $values);
            } elseif ($element instanceof TranslatableElement) {
                if ($element->isTranslatable()) {
                    foreach (\Halfdream::locales() as $locale) {
                        $element->setTranslatableLocale($locale);
                        // After locale is set
                        $value = \Illuminate\Support\Arr::get($values, $element->getTranslatableDotField());
                        $element->setTranslatableValue($value);
                    }
                } else {
                    $value = \Illuminate\Support\Arr::get($values, $element->getTranslatableDotField());
                    $element->setTranslatableValue($value);
                }
            }
        }
    }

    /**
     * @param NavigationLink[]|NavigationLink[] $links
     * @return NavigationLink[]
     */
    public function adminNavigation($links = []) {
        if ($links) {
            if (is_array($links)) {
                foreach ($links as $link) {
                    $this->adminNavigation($link);
                }
            } else {
                $this->adminNavigation[] = $links;
            }
        }
        return $this->adminNavigation;
    }

    /**
     * Add column for migration depends on settings (JSON for MySQL 5.7+ or text).
     * @param \Illuminate\Database\Schema\Blueprint $table
     * @param $column
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function dbJSONField(Blueprint $table, $column) {
        return config('halfdream.db_json') ? $table->json($column) : $table->text($column);
    }

    /**
     * @param \Illuminate\Database\Schema\Blueprint $table
     */
    public function dbSEOFields(Blueprint $table) {
        $this->dbJSONField($table, 'seo_url')->nullable();
        $this->dbJSONField($table, 'seo_title')->nullable();
        $this->dbJSONField($table, 'seo_image')->nullable();
        $this->dbJSONField($table, 'meta_description')->nullable();
        $this->dbJSONField($table, 'meta_keywords')->nullable();
    }

    /**
     * @param $key
     * @return \Illuminate\Support\Collection
     */
    public function menu($key) {
        $menu = Menu::where('key', $key)->with('children')->first();
        if ($menu) {
            return $menu->children;
        } else {
            return collect();
        }
    }

    /**
     * @param $key
     * @return null|\KuzyT\Halfdream\Models\Icon
     */
    public function icon($key) {
        $keys = explode('.', $key);
        if (count($keys) > 1) {
            return Icon::where('type', $keys[0])->where('icon', $keys[1])->first();
        }
        return null;
    }

    /**
     * Prepare Font Awesome icon
     * @param $icon
     * @return string
     */
    public function prepareFAIcon($icon) {
        $icons = explode('.', $icon);
        if (count($icons) == 1) {
            // Default Font Awesome icon type is FAS
            $icons = array_merge(['fas'], $icons);
        }
        return "['" . implode("','", $icons) . "']";
    }

    /**
     * Create a route group with shared attributes.
     * Translatable version.
     *
     * @param array $attributes
     * @param \Closure|string $routes
     * @return void
     * @static
     */
    public function translatableRouteGroup($attributes = [], $routes = null) {
        if (\Halfdream::multiLocale()) {
            // Version with locale
            $localAttributes = $attributes;
            $localAttributes['prefix'] = '{locale}';
            $localAttributes['where'] = array_merge(
                (key_exists('where', $localAttributes) ? $localAttributes['where'] : []),
                ['locale' => '(' . implode('|', \Halfdream::locales()) . ')']
            );
            \Route::group($localAttributes, $routes);

            // Special version for redirects to locale
            // Must be after translatable version
            $attributes['as'] = (key_exists('as', $attributes) ? $attributes['as'] : '') . $this->getRedirectablePrefix();
            \Route::group($attributes, $routes);
        } else {
            \Route::group($attributes, $routes);
        }
    }

    /**
     * Constant for redirectable routes version from translatable route group.
     * If it in route - it must be redirect from TranslatableController.
     * @return string
     */
    protected function getRedirectablePrefix() {
        return 'hdredirect.';
    }

    /**
     * @param \Illuminate\Routing\Route $route
     * @return bool
     */
    public function isRedirectableRoute(\Illuminate\Routing\Route $route) {
        return Str::contains($route->getName(), $this->getRedirectablePrefix());
    }

    /**
     * @param \Illuminate\Routing\Route $route
     * @return string
     */
    public function routeFromRedirectable(\Illuminate\Routing\Route $route) {
        return Str::replaceFirst($this->getRedirectablePrefix(), '', $route->getName());
    }
}
