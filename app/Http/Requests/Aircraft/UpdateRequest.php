<?php

namespace App\Http\Requests\Aircraft;

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
            'model' => 'string|max:50',
            'range' => 'int|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'Поле ":attribute" должно быть строкой',
            'int' => 'Поле ":attribute" должно быть числом',
            'max' => 'Поле ":attribute" не должно быть длиннее 50 символов',
            'min' => 'Поле ":attribute" должно быть больше 0',
        ];
    }
}
