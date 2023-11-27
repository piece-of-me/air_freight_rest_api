<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seats extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const BUSINESS = 'Business';
    public const COMFORT = 'Comfort';
    public const ECONOMY = 'Economy';

    protected $table = 'seats';
    protected $guarded = false;
    public $timestamps = true;

    public static function getAllowedFareConditions(): array
    {
        return [
            static::BUSINESS,
            static::COMFORT,
            static::ECONOMY,
        ];
    }
}
