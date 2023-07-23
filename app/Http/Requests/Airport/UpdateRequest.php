<?php

namespace App\Http\Requests\Airport;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;
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
            'name' => 'string|max:100',
            'city' => 'string|max:100',
            'longitude' => 'string|max:20',
            'latitude' => 'string|max:20',
            'timezone' => 'string|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'Поле ":attribute" должно быть строкой',
            'max' => 'Поле ":attribute" не должно быть длиннее :max символов',
        ];
    }
}
