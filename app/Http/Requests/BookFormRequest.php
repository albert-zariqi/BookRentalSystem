<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFormRequest extends FormRequest
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
            'title' => 'required',
            'authors' => 'required',
            'description' => 'nullable',
            'release_date' => 'required',
            'cover_image' => 'nullable|url',
            'pages' => 'required',
            'language_code' => 'required',
            'isbn' => 'required|unique:books',
            'in_stock' => 'required'
        ];
    }
}
