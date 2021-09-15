<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        switch ($this->getMethod()) {
            case "POST":
                return [
                    "name" => ["required", "string", "max:250"],
                    "price" => ["required", "numeric"],
                    "categories_ids" => ["required", "array"],
                    "categories_ids.*" => ["exists:categories,id"],
                    "published" => ["sometimes", "boolean"]
                ];
            case "PUT":
                return [
                    "name" => ["sometimes", "string", "max:250"],
                    "price" => ["sometimes", "numeric"],
                    "categories_ids" => ["sometimes", "array"],
                    "categories_ids.*" => ["sometimes", "exists:categories,id"],
                    "published" => ["sometimes", "boolean"]
                ];
            default:
                return [];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
