<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends ApiValidator
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
            'name'  =>  'required|string',
            'category_id'  =>  'required|exists:categories,id',
            'image_path'  =>  'required|string',
            'shelf_id'  =>  'required|integer|exists:shelves,id',
            'is_digit'  =>  'required',
            'book_path'  =>  'required|string',
            'genres'    =>  'required',
            'authors'   =>  'required',
        ];
    }
}
