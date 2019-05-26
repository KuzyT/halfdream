<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 18.03.2019
 */

namespace KuzyT\Halfdream\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Image extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
