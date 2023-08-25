<?php

namespace App\Http\Requests\Flight;

use App\Models\Flight;
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
            'flight_no' => 'string|size:6',
            'scheduled_departure' => 'string',
            'scheduled_arrival' => 'string',
            'departure_airport' => 'string',
            'arrival_airport' => 'string',
            'status' => ['string', 'in:' . implode(',', Flight::getAllowedStatuses())],
            'aircraft_code' => 'string|size:3',
            'actual_departure' => 'string',
            'actual_arrival' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'Поле ":attribute" должно быть строкой',
            'in' => 'Поле ":attribute" должно быть одним из возможных вариантов',
            'size' => 'Длинна поля ":attribute" должна быть :size символов'
        ];
    }
}
