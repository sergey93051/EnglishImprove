<?php

namespace App\Http\Requests\Api\Auth\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserInformationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'         => 'nullable|string|min:3|max:15',
            'address'      => 'nullable|string|min:3|max:15',
            'phone'        => 'nullable|string|min:6|max:15',
            'phone_code'   => 'nullable|string|min:2|max:5',
            'age'          => 'nullable|numeric|min:14|max:99',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ],422));
    }
}
