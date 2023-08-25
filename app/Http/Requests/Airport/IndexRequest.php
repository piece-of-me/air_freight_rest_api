<?php

namespace App\Http\Requests\Airport;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'airport_code' => 'string|size:3',
            'airport_name' => 'string',
            'city' => 'string',
            'timezone' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'Поле ":attribute" должно быть строкой',
            'size' => 'Длинна поля ":attribute" должна быть :size символов'
        ];
    }
}
