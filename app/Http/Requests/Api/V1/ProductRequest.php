<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:250"],
            "price" => ["required", "numeric"],
            "published" => ["sometimes", "boolean"]
        ];
    }
}
