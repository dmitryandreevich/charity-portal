<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type', 'vkId', 'fbId','data','phone', 'city', 'vol_type_org'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function getData(User $user){
        return json_decode($user->data);
    }
    public function setEmailAttribute($value) {
        if ( empty($value) ) {
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }
    public function setVkIdAttribute($value) {
        if ( empty($value) ) {
            $this->attributes['vkId'] = NULL;
        } else {
            $this->attributes['vkId'] = $value;
        }
    }
    public function setFbIdAttribute($value) {
        if ( empty($value) ) {
            $this->attributes['fbId'] = NULL;
        } else {
            $this->attributes['fbId'] = $value;
        }
    }
}
