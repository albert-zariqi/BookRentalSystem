<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BorrowFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()){
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
            'reader_id' => 'required|integer',
            'book_id' => 'required|integer',
            'status' => 'required|in:PENDING,ACCEPTED,REJECTED,RETURNED',
            'deadline' => 'nullable|date'
        ];
    }
}
