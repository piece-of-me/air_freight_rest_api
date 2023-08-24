<?php

namespace App\Rules\Flight;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NotDepartureAirport implements DataAwareRule, ValidationRule
{
    protected array $data;

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === $this->data['departure_airport']) {
            $fail('Невозможно указать аэропорт вылета в качестве аэропорта прибытия');
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
}
