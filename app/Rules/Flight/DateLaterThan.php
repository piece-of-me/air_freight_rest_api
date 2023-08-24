<?php

namespace App\Rules\Flight;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class DateLaterThan implements DataAwareRule, ValidationRule
{
    protected array $data;

    /**
     * @param string $key
     */
    public function __construct(protected string $key)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     * @throws \Exception
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!isset($this->data[$this->key])) {
            $fail('Поле "' . $this->key . '" должно присутствовать');
            return;
        }
        if ((new \DateTime($this->data[$this->key])) >= (new \DateTime($value))) {
            $fail('Дата в поле ":attribute" должно быть больше даты в поле "' . $this->key . '"');
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
}
