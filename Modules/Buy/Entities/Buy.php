<?php

namespace Modules\Buy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

class Buy extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];


    public function role()
    {
        return $this->belongsTo(Role::class);

    }

}
