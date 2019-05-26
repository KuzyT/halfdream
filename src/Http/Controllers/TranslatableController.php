<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 24.05.2019
 */

namespace KuzyT\Halfdream\Http\Controllers;

use Illuminate\Http\Request;
use KuzyT\Halfdream\General\Traits\Controllers\IsTranslatableController;

class TranslatableController extends Controller
{
    use IsTranslatableController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->redirectTranslatable($request);
    }
}