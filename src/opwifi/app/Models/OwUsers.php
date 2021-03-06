<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class OwUsers extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ow_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'right', 'timezone'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function deviceMeta()
    {
        return $this->hasMany('App\Models\OwDevicemeta', 'mnger_id');
    }

    public function deviceConfig()
    {
        return $this->hasMany('App\Models\OwDevConfigs', 'mnger_id');
    }

    public function deviceFirmware()
    {
        return $this->hasMany('App\Models\OwDevFirmwares', 'mnger_id');
    }

    public function webportalConfig()
    {
        return $this->hasMany('App\Models\OwWebportalConfigs', 'mnger_id');
    }

    public function webportalDevice()
    {
        return $this->hasMany('App\Models\OwWebportalDevices', 'mnger_id');
    }
}
