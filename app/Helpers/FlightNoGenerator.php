<?php

namespace App\Helpers;

class FlightNoGenerator
{
    private static string $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function generate(): string
    {
        return self::_generateLiteralPart() . self::_generateNumericPart();
    }

    private static function _generateLiteralPart(): string
    {
        $size = strlen(self::$letters);
        $result = '';
        for ($i = 0; $i < 2; $i++) {
            $result .= substr(self::$letters, rand(0, $size), 1);
        }
        return $result;
    }

    private static function _generateNumericPart(): string
    {
        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $result .= rand(0, 9);
        }
        return $result;
    }
}
