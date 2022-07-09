<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 21.02.2019
 */

namespace KuzyT\Halfdream\Http\Controllers\Admin;

use KuzyT\Halfdream\General\HalfdreamModule;
use KuzyT\Halfdream\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Halfdream;

class ModuleController extends Controller
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
        $key = $request->route('module');
        $this->module = Halfdream::loadModuleByKey($key);

        if (!$this->module) {
            abort(404);
        }

        $request->route()->forgetParameter('module');

        Halfdream::script()->locale();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $display = $this->module->initDisplay();
        $title = $this->module->getTitle('display');
        $meta = ['title' => $title];

        return view('halfdream::admin.display', ['meta' => $meta, 'display' => $display, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->module->initForm();
        $title = $this->module->getTitle('create');
        $meta = ['title' => $title];

        // todo - change for using with breadcrumbs
        // Save previous link for module-in-module redirects
        //session()->flash('back', url()->previous());

        return view('halfdream::admin.form', ['meta' => $meta, 'form' => $form, 'id' => null, 'title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $model = $this->module->create();

        // Init form with current model and validate it
        $form = $this->module->initForm($model);
        $validated = $this->module->validateForm($request, $form);

        $this->module->setForm($validated, $form);
        // This is that model that we needed, cause we init form with it
        $model->save();

        // todo - change for using with breadcrumbs
        if (session()->exists('back')) {
            $back = session()->pull('back');
            $parsedBack = parse_url($back);
            $pathParsedBack = preg_replace(['~^(\/)+~', '~(\/)+$~'], ['', ''], $parsedBack['path']);
            if (!\Request::is($pathParsedBack)) {
                return redirect()->to($back);
            }
        }

        return redirect()->route('admin.module.index', ['module' => $this->module->getKey()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  mixed  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->module->find($id);
        if (!$model) {
            abort(404);
        }

        $form = $this->module->initForm($model);
        $title = $this->module->getTitle('edit');
        $meta = ['title' => $title];

        // todo - change for using with breadcrumbs
        // Save previous link for module-in-module redirects
        //session()->flash('back', url()->previous());

        return view('halfdream::admin.form', ['meta' => $meta, 'form' => $form, 'id' => $id, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $model = $this->module->find($id);
        if (!$model) {
            abort(404);
        }

        // Init form with current model and validate it
        $form = $this->module->initForm($model);
        $validated = $this->module->validateForm($request, $form);

        $this->module->setForm($validated, $form);
        // This is that model that we needed, cause we init form with it
        $model->save();

        // todo - change for using with breadcrumbs
        if (session()->exists('back')) {
            $back = session()->pull('back');
            $parsedBack = parse_url($back);
            $pathParsedBack = preg_replace(['~^(\/)+~', '~(\/)+$~'], ['', ''], $parsedBack['path']);
            if (!\Request::is($pathParsedBack)) {
                return redirect()->to($back);
            }
        }

        return redirect()->route('admin.module.index', ['module' => $this->module->getKey()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  mixed  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $model = $this->module->find($id);
        if (!$model) {
            $request->session()->flash('flash_danger', __('halfdream::admin.error.404'));
            return response()->json([], 404);
        }

        if ($model->delete()) {
            $request->session()->flash('flash_success', __('halfdream::admin.delete.success'));
            return response()->json([], 200);
        } else {
            $request->session()->flash('flash_danger', __('halfdream::admin.error.400'));
            return response()->json([], 400);
        }
    }
}
