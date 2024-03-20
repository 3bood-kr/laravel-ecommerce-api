<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Jiannei\Enum\Laravel\Repositories\Enums\HttpStatusCodeEnum;
use Jiannei\Response\Laravel\Support\Facades\Response;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
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
