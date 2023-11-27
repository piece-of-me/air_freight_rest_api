<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketFlight extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'ticket_flights';
    protected $guarded = false;
}
