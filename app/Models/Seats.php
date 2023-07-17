<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seats extends Model
{
    use SoftDeletes;

    protected $table = 'seats';
    protected $guarded = false;
    public $timestamps = true;
}
