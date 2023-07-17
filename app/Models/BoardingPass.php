<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardingPass extends Model
{
    use SoftDeletes;

    protected $table = 'boarding_passes';
    protected $guarded = false;
    public $timestamps = true;
}
