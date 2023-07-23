<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model
{
    use SoftDeletes;

    protected $table = 'airports';
    protected $primaryKey = 'airport_code';
    public $incrementing = false;
    protected $guarded = false;
    public $timestamps = true;
}
