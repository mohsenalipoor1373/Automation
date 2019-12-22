<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Fractions\Entities\Fractions;
use Modules\Leave\Entities\Leave;
use Modules\Mission\Entities\Mission;
use Modules\Overtime\Entities\Overtime;
use Modules\TheRule\Entities\TheRule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'personnel_id', 'phone', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function therules()
    {
        return $this->hasMany(TheRule::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function fractions()
    {
        return $this->hasMany(Fractions::class);
    }

    public function overtimes()
    {
        return $this->belongsTo(Overtime::class);
    }

    public function missions()
    {
        return $this->belongsTo(Mission::class);
    }
}
