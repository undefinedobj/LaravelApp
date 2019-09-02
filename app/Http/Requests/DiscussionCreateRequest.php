<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionCreateRequest extends FormRequest
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
            'title'     => 'required',
            'preface'   => 'required',
            'img'       => 'required|image|mimes:jpeg,jpg,png,gif',
            'sort'      => 'nullable|integer',
            'body'      => 'required',
        ];
    }
}
