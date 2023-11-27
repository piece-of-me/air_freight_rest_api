<?php

namespace App\Faker;

use Faker\Provider\Base;

class AirportProvider extends Base
{
    private static array $airportNames = [
        'Липецк',
        'Уйташ',
        'Талаги',
        'Чульман',
        'Калуга',
        'Уфа',
        'Новый Уренгой',
        'Баратаевка',
        'Иваново-Южный',
        'Нарьян-Мар',
        'Емельяново',
        'Белгород',
        'Ульяновск-Восточный',
        'Елизово',
        'Салехард',
        'Байкал',
        'Грозный',
        'Орск',
        'Нижневартовск',
        'Астрахань',
        'Минеральные Воды',
        'Когалым',
        'Краснодар',
        'Кемерово',
        'Саранск',
        'Бесовец',
        'Братск',
        'Якутск',
        'Казань',
        'Белоярский',
        'Пенза',
        'Внуково',
        'Стригино',
        'Омск-Центральный',
        'Пермь',
        'Сургут',
        'Чебоксары',
        'Оренбург-Центральный',
        'Надым',
        'Сыктывкар',
        'Нальчик',
        'Иркутск',
        'Хомутово',
        'Толмачёво',
        'Норильск',
        'Советский',
        'Ростов-на-Дону',
        'Туношна',
        'Хабаровск-Новый',
        'Победилово',
        'Курумоч',
        'Ставрополь',
        'Йошкар-Ола',
        'Кызыл',
        'Воронеж',
        'Беслан',
        'Мирный',
        'Стрежевой',
        'Гумрак',
        'Донское',
        'Горно-Алтайск',
        'Геленджик',
        'Шереметьево',
        'Петрозаводск',
        'Усть-Кут',
        'Магадан',
        'Абакан',
        'Полярный',
        'Пулково',
        'Кольцово',
        'Воркута',
        'Игнатьево',
        'Курск-Восточный',
        'Спиченково',
        'Бегишево',
        'Рощино',
        'Чита',
        'Анадырь',
        'Усинск',
        'Брянск',
        'Мурманск',
        'Череповец',
        'Хурба',
        'Челябинск',
        'Бугульма',
        'Витязево',
        'Сочи',
        'Усть-Илимск',
        'Храброво',
        'Домодедово',
        'Ухта',
        'Элиста',
        'Барнаул',
        'Нефтеюганск',
        'Ханты-Мансийск',
        'Псков',
        'Магнитогорск',
        'Саратов-Центральный',
        'Богашёво',
        'Нягань',
        'Курган',
        'Ноябрьск',
        'Ижевск',
        'Владивосток',
    ];

    public static function airportCode(): string
    {
        return join('', [
            strtoupper(static::randomLetter()),
            strtoupper(static::randomLetter()),
            strtoupper(static::randomLetter()),
        ]);
    }

    public static function airportName(): string
    {
        return static::randomElement(static::$airportNames);
    }
}