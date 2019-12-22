<?php

namespace Modules\Fish\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fish extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
}
