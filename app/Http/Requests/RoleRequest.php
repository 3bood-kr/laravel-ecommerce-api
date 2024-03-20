<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Jiannei\Enum\Laravel\Repositories\Enums\HttpStatusCodeEnum;
use Jiannei\Response\Laravel\Support\Facades\Response;

class RoleRequest extends FormRequest
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
        return [
            'name' => 'string|min:3|max:15',
            'display_name' => 'string',
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',

        ];
    }
    protected function prepareForValidation()
    {
        return $this->merge([
            'guard_name' => 'web',
        ]);
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::fail(
            code: HttpStatusCodeEnum::HTTP_UNPROCESSABLE_ENTITY,
            errors: $validator->errors(),
        ));
    }
}
