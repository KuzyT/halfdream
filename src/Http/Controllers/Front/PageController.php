<?php

namespace KuzyT\Halfdream\Http\Controllers\Front;

use Illuminate\Http\Request;
use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Http\Controllers\TranslatableController;
use KuzyT\Halfdream\Modules\PageModule;

class PageController extends TranslatableController
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

        $this->module = new PageModule;

        if (!$this->module) {
            abort(404);
        }
    }

    /**
     * Page list
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

        return view('modules.page.show', compact('item', 'meta'));
    }
}
