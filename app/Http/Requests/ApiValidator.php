<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiValidator extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        return response()
            ->json([
                'Bearer' => 'error',
            ])
            ->throwResponse();
    }
}
