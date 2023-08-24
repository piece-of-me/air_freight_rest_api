<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use SoftDeletes;

    protected $table = 'flights';
    protected $primaryKey = 'flight_id';
    protected $guarded = false;
    public $timestamps = true;

    public const STATUS_ARRIVED = 'Arrived';
    public const STATUS_SCHEDULED = 'Scheduled';
    public const STATUS_ON_TIME = 'On Time';
    public const STATUS_DEPARTED = 'Departed';
    public const STATUS_DELAYED = 'Delayed';
    public const STATUS_CANCELLED = 'Cancelled';

    public function departureAirport(): belongsTo
    {
        return $this->belongsTo(Airport::class, 'departure_airport', 'airport_code');
    }

    public function arrivalAirport(): belongsTo
    {
        return $this->belongsTo(Airport::class, 'arrival_airport', 'airport_code');
    }

    public function aircraft(): belongsTo
    {
        return $this->belongsTo(Aircraft::class, 'aircraft_code', 'aircraft_code');
    }

    public static function getAllowedStatuses(): array
    {
        return [
            self::STATUS_ARRIVED,
            self::STATUS_SCHEDULED,
            self::STATUS_ON_TIME,
            self::STATUS_DEPARTED,
            self::STATUS_DELAYED,
            self::STATUS_CANCELLED,
        ];
    }
}
