<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalStoreRequest extends ApiValidator
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
            'user_id'   =>  'required|integer|exists:users,id',
            'book_id'   =>  'required|integer|exists:books,id',
            'start_date'   =>  'required|date',
            'end_date'   =>  'required|date',
            'status'   =>  'boolean',

        ];
    }
}
