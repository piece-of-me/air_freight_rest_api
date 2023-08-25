<?php

namespace App\Models;

use App\Helpers\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model
{
    use SoftDeletes;
    use Filterable;

    protected $table = 'airports';
    protected $primaryKey = 'airport_code';
    public $incrementing = false;
    protected $guarded = false;
    public $timestamps = true;
}
