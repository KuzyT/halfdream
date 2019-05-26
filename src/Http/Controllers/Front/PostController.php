<?php

namespace KuzyT\Halfdream\Http\Controllers\Front;

use Illuminate\Http\Request;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Http\Controllers\TranslatableController;
use KuzyT\Halfdream\Modules\PostModule;

class PostController extends TranslatableController
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

        $this->module = new PostModule;

        if (!$this->module) {
            abort(404);
        }
    }

    /**
     * Post list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->module->getTitle('front');
        $meta = [];
        $meta['title'] = $meta['ogtitle'] = $title;

        $items = $this->module->query()->with('category')->orderBy('id', 'desc')->paginate(config('halfdream.modules.post.per_page'));

        return view('modules.post.index', compact('items', 'meta'));
    }

    /**
     * Post show
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $seo)
    {
        $item = $this->module->find($id);

        if (!$item) {
            abort(404);
        }

        $meta = $item->getMeta();

        return view('modules.post.show', compact('item', 'meta'));
    }
}
