<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Illuminate\Validation\Rule;

class BookFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check() && Auth::user()->is_librarian){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'description' => 'nullable',
            'released_at' => 'required|date|before:now',
            'cover_image' => 'nullable|url',
            'pages' => 'required|integer|min:1',
            'language_code' => 'max:3',
            'isbn' => ['required',
                        'regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
                        Rule::unique('books')->ignore(request('book'))],
            'in_stock' => 'required|integer|min:0',
            'genres' => 'required|array|exists:genres,id'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['language_code'] = [
                'required',
                'max:255'
            ];
        }
        return $rules;
    }
}
