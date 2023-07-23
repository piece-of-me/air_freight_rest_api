<?php

namespace App\Http\Requests\Airport;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'code' => 'required|string|max:3|unique:airports,airport_code',
            'name' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'longitude' => 'required|string|max:20',
            'latitude' => 'required|string|max:20',
            'timezone' => 'required|string|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" должно присутствовать',
            'string' => 'Поле ":attribute" должно быть строкой',
            'max' => 'Поле ":attribute" не должно быть длиннее :max символов',
            'code.unique' => 'Аэропорт с кодом :input уже существует',
        ];
    }
}
