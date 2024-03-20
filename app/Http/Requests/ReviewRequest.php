<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Jiannei\Enum\Laravel\Repositories\Enums\HttpStatusCodeEnum;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ReviewRequest extends FormRequest
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
            'product_id' => 'numeric|exists:products,id',
            'comment' => 'string|min:3|max:255',
            'rating' => 'numeric|min:1|max:5',
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
