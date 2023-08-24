<?php

namespace App\Http\Requests\Flight;

use App\Models\Flight;
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
            'status' => 'required_without_all:aircraft_code,actual_departure,actual_arrival|in:' . implode(',', Flight::getAllowedStatuses()),
            'aircraft_code' => 'required_without_all:status,actual_departure,actual_arrival|exists:aircrafts,aircraft_code',
            'actual_departure' => 'required_without_all:status,aircraft_code,actual_arrival|date_format:Y-m-d H:i:s',
            'actual_arrival' => 'required_without_all:status,aircraft_code,actual_departure|date_format:Y-m-d H:i:s',
        ];
    }

    public function messages(): array
    {
        return [
            'in' => 'Поле ":attribute" должно быть одним из возможных вариантов',
            'exists' => 'Поле ":attribute" должно существовать в базе данных',
            'date_format' => 'В поле ":attribute" указан неверный формат даты',
            'required_without_all' => 'Необходимо передать хотя бы один параметр'
        ];
    }
}
