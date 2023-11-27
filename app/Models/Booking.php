<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'book_ref';
    protected $keyType = 'string';
    protected $guarded = false;
}
