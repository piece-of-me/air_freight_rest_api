<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class AirportFilter extends AbstractFilter
{
    public const AIRPORT_CODE = 'airport_code';
    public const AIRPORT_NAME = 'airport_name';
    public const CITY = 'city';
    public const TIMEZONE = 'timezone';

    protected function getCallbacks(): array
    {
        return [
            self::AIRPORT_CODE => [$this, 'filterByAirportCode'],
            self::AIRPORT_NAME => [$this, 'filterByAirportName'],
            self::CITY => [$this, 'filterByCity'],
            self::TIMEZONE => [$this, 'filterByTimezone'],
        ];
    }

    public function filterByAirportCode(Builder $builder, $value): void
    {
        $builder->where('airport_code', '=', $value);
    }

    public function filterByAirportName(Builder $builder, $value): void
    {
        $builder->where('airport_name', 'like', '%' . $value . '%');
    }

    public function filterByCity(Builder $builder, $value): void
    {
        $builder->where('city', 'like', '%' . $value . '%');
    }

    public function filterByTimezone(Builder $builder, $value): void
    {
        $builder->where('timezone', 'like', '%' . $value . '%');
    }
}