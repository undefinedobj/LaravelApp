<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionUpdateRequest extends FormRequest
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
            'title'         => 'required',
            'preface'       => 'required',
            'order'         => 'nullable|integer',
            'body'          => 'required',
            'categories_id' => 'required|nullable|integer'
        ];
    }
}
