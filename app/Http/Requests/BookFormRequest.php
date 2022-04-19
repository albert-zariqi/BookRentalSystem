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
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'description' => 'nullable',
            'release_date' => 'required|before:now',
            'cover_image' => 'nullable|url',
            'pages' => 'required|min:1',
            'language_code' => 'required',
            'isbn' => 'required|unique:books|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
            'in_stock' => 'required|min:0',
            'genres' => 'required|array'
        ];
    }
}
