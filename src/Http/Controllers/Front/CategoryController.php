<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.05.2019
 */

namespace KuzyT\Halfdream\Http\Controllers\Front;

use Illuminate\Http\Request;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Http\Controllers\TranslatableController;
use KuzyT\Halfdream\Modules\CategoryModule;
use KuzyT\Halfdream\Modules\PostModule;

class CategoryController extends TranslatableController
{
    /**
     * @var HalfdreamModule
     */
    protected $module;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->module = new CategoryModule;

        if (!$this->module) {
            abort(404);
        }
    }

    /**
     * Category list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->module->getTitle('front');
        $meta = ['title' => $title];

        $items = $this->module->query()->withCount('posts')->paginate(config('halfdream.modules.category.per_page'));

        return view('modules.category.index', compact('items', 'meta'));
    }

    /**
     * Show posts in category
     *
     * @return \Illuminate\Http\Response
     */
    public function show($seo)
    {
        $item = $this->module->find($seo, 'seo_url', locale());

        if (!$item) {
            abort(404);
        }

        $meta = $item->getMeta();

        $items = (new PostModule())->query()->paginate(config('halfdream.modules.post.per_page'));

        return view('modules.category.show', compact('item', 'items', 'meta'));
    }
}
