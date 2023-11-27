<?php

namespace App\Faker;

use App\Helpers\FlightNoGenerator;
use App\Models\Flight;
use Faker\Provider\Base;
use Faker\Provider\DateTime;
use Faker\Provider\Miscellaneous;

class FlightProvider extends Base
{
    public static function flightNo(): string
    {
        return FlightNoGenerator::generate();
    }

    public static function status(): string
    {
        return static::randomElement(Flight::getAllowedStatuses());
    }

    /**
     * Генерация фактического и по расписанию времени вылета и времени прилета
     * @return array [Время вылета по расписанию, время прилета по расписанию, фактическое время вылета, фактическое время прилёта]
     * @throws \Exception
     */
    public static function scheduledAndActual(): array
    {
        $scheduledDeparture = DateTime::dateTimeThisYear();
        $scheduledDeparture = $scheduledDeparture->format(Flight::DATE_TIME_FORMAT);

        $scheduledArrival = new \DateTime($scheduledDeparture);
        $scheduledArrival->add(new \DateInterval('PT' . static::numberBetween(100, 500) . 'M'));
        $scheduledArrival = $scheduledArrival->format(Flight::DATE_TIME_FORMAT);

        $actualDeparture = new \DateTime($scheduledDeparture);
        if (Miscellaneous::boolean()) {
            $actualDeparture->add(new \DateInterval('PT' . static::numberBetween(1, 30) . 'M'));
        } else {
            $actualDeparture->sub(new \DateInterval('PT' . static::numberBetween(1, 30) . 'M'));
        }

        $actualArrival = new \DateTime($scheduledArrival);
        if (Miscellaneous::boolean()) {
            $actualArrival->add(new \DateInterval('PT' . static::numberBetween(1, 30) . 'M'));
        } else {
            $actualArrival->sub(new \DateInterval('PT' . static::numberBetween(1, 30) . 'M'));
        }

        return [
            $scheduledDeparture,
            $scheduledArrival,
            $actualDeparture->format(Flight::DATE_TIME_FORMAT),
            $actualArrival->format(Flight::DATE_TIME_FORMAT),
        ];
    }
}
