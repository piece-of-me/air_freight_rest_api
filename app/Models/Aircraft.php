<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aircraft extends Model
{
    use SoftDeletes;

    protected $table = 'aircrafts';
    protected $primaryKey = 'aircraft_code';
    public $incrementing = false;
    protected $guarded = false;
    public $timestamps = true;
}
