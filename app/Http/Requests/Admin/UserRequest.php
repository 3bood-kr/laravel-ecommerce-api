<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;
use Jiannei\Enum\Laravel\Repositories\Enums\HttpStatusCodeEnum;
use Jiannei\Response\Laravel\Support\Facades\Response;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $required = 'required';
        if($this->isMethod('PUT')){
            $required = '';
        }
        return [
            'name' => "{$required}|string|min:3|max:20",
            'email' => "{$required}|email|unique:users",
            'password' => "{$required}|string",
            'role' => "{$required}|exists:roles,name",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::fail(
            code: HttpStatusCodeEnum::HTTP_UNPROCESSABLE_ENTITY,
            errors: $validator->errors(),
        ));
    }
}
