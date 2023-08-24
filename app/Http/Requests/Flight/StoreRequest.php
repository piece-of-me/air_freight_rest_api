<?php

namespace App\Http\Requests\Flight;

use App\Models\Flight;
use App\Rules\Flight\DateLaterThan;
use App\Rules\Flight\NotDepartureAirport;
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
            'scheduled_departure' => 'required|date_format:Y-m-d H:i:s',
            'scheduled_arrival' => ['required', 'date_format:Y-m-d H:i:s', new DateLaterThan('scheduled_departure')],
            'departure_airport' => 'required|string|exists:airports,airport_code',
            'arrival_airport' => ['required', 'string', 'exists:airports,airport_code', new NotDepartureAirport],
            'status' => 'required|in:' . implode(',', Flight::getAllowedStatuses()),
            'aircraft_code' => 'required|exists:aircrafts,aircraft_code',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" должно присутствовать',
            'string' => 'Поле ":attribute" должно быть строкой',
            'in' => 'Поле ":attribute" должно быть одним из возможных вариантов',
            'exists' => 'Поле ":attribute" должно существовать в базе данных',
            'date_format' => 'В поле ":attribute" указан неверный формат даты',
        ];
    }
}
