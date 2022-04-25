<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

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
        return [
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'description' => 'nullable',
            'release_date' => 'required|date',
            'cover_image' => 'nullable|url',
            'pages' => 'required|integer|min:1',
            'language_code' => 'required|max:3',
            'isbn' => 'required|unique:books|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
            'in_stock' => 'required|integer|min:0',
            'genres' => 'array|nullable'
        ];
    }
}
