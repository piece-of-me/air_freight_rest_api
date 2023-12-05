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
            'model' => 'required_without:range|string|max:50',
            'range' => 'required_without:model|integer|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'required_without' => 'Необходимо передать хотя бы одно из указанных полей: model, range',
            'string' => 'Поле ":attribute" должно быть строкой',
            'integer' => 'Поле ":attribute" должно быть числом',
            'max' => 'Поле ":attribute" не должно быть длиннее :max символов',
            'min' => 'Поле ":attribute" должно быть больше 0',
        ];
    }
}
