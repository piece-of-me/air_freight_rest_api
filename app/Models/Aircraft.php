<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aircraft extends Model
{
    use SoftDeletes;

    protected $table = 'aircrafts';
    protected $guarded = false;
    public $timestamps = true;
}
