<?php

namespace App\Http\Requests\Aircraft;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
            'code' => 'required|string|max:3|unique:aircrafts,aircraft_code',
            'model' => 'required|string|max:50',
            'range' => 'required|int|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" должно присутствовать',
            'string' => 'Поле ":attribute" должно быть строкой',
            'int' => 'Поле ":attribute" должно быть числом',
            'max' => 'Поле ":attribute" не должно быть длиннее 3 символов',
            'min' => 'Поле ":attribute" должно быть больше 0',
            'code.unique' => 'Судно с кодом :input уже существует',
        ];
    }
}
