<?php

namespace App\Faker;

use Faker\Provider\Base;

class AircraftProvider extends Base
{
    private static array $alphabet = [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
    ];

    private static array $models = [
        'Boeing 777X',
        'Boeing Monomail',
        'Bombardier CRJ',
        'Bombardier CRJ200',
        'Bombardier CRJ700',
        'Bombardier Q Series',
        'De Havilland Canada Dash 7',
        'De Havilland Canada DHC-5 Buffalo',
        'De Havilland Canada DHC-6 Twin Otter',
        'Let L-410 Turbolet',
        'Learjet 28',
        'Let L-200 Morava',
        'Fairchild Dornier 328JET',
        'Fairchild Hiller FH-227',
        'Fairchild Swearingen Metroliner',
        'Fokker F.XXII',
        'Fokker F27 Friendship',
        'Fokker F28 Fellowship',
    ];

    public static function aircraftCode(): string
    {
        return join('', static::randomElements(static::$alphabet, 3));
    }

    public static function model(): string
    {
        return static::randomElement(static::$models);
    }

    public static function range(): int
    {
        return static::numberBetween(10, 99) * 100;
    }
}
