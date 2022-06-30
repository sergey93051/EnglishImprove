<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Service\Api\V1\RoleService;
use App\Http\Service\Api\V1\UserService;
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
            'email'      => 'required|email|unique:user_emails',
            'password'   => 'required|min:6|max:15',
            'role'       => 'required|'.Rule::in(['student', 'teacher']),
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

    public function register()
    {
        $user = UserService::getInstance()->register($this);
        $role = $this->role ?? 'student' ;

        RoleService::getInstance()->create($user->id , $role);

        return $user;

    }
}
