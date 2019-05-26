<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 17.02.2019
 */

namespace KuzyT\Halfdream\Http\Controllers\Admin;

class AdminController
{
    /**
     * Admin area main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = config('halfdream.admin.title');
        $meta = ['title' => $title];

        return view('halfdream::admin.index', ['meta' => $meta, 'title' => $title]);
    }

}
