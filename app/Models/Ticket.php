<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'ticket_no';
    protected $guarded = false;

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class, 'book_ref', 'book_ref');
    }
}
