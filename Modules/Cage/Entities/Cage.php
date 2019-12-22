<?php

namespace Modules\Cage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cage extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
}
