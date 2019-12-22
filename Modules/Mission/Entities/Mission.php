<?php

namespace Modules\Mission\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
