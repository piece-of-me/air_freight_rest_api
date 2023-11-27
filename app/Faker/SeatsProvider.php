<?php

namespace App\Faker;

use App\Models\Seats;
use Faker\Provider\Base;
use Faker\Provider\Miscellaneous;

class SeatsProvider extends Base
{
    public static function seatNo(): string
    {
        $length = static::numberBetween(3, 9);
        $res = [];
        for ($i = 0; $i < $length; $i++) {
            if (Miscellaneous::boolean()) {
                $res[] = static::numberBetween(0, 9);
            } else {
                $res[] = strtoupper(static::randomLetter());
            }
        }
        return join(static::shuffle($res));
    }

    public static function fareCondition(): string
    {
        return static::randomElement(Seats::getAllowedFareConditions());
    }
}
