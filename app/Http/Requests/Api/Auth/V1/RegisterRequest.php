<?php

namespace App\Http\Requests\Api\Auth\V1;

use App\Http\Service\Api\RoleService;
use App\Http\Service\Api\UserService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:6|max:15',
            'role'       => Rule::in(['student', 'teacher']),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ]),400);
    }

    public function register()
    {
            $user = UserService::getInstance()->register($this);
            $role = $this->role ?? 'student' ;

            RoleService::getInstance()->create($user->id , $role);

            return $user;

    }
}
